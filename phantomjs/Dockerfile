FROM google/debian:wheezy

RUN apt-get update
RUN apt-get -y install supervisor nginx curl bzip2 libfreetype6 libfontconfig

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN mkdir -p /var/log/supervisor

COPY nginx.conf /etc/nginx/nginx.conf
COPY ok /usr/share/nginx/www/_ah/start
COPY ok /usr/share/nginx/www/_ah/health

ENV DEBIAN_FRONTEND noninteractive
ENV PHANTOM_JS_VERSION 1.9.8-linux-x86_64
RUN curl -sSL https://bitbucket.org/ariya/phantomjs/downloads/phantomjs-$PHANTOM_JS_VERSION.tar.bz2 | tar xjC /
RUN ln -s phantomjs-$PHANTOM_JS_VERSION /phantomjs

EXPOSE 8080
CMD ["/usr/bin/supervisord"]