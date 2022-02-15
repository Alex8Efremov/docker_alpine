FROM alpine:latest
MAINTAINER devops@ava-it.ru

RUN apk add --no-cache --update \
    nginx \
    php8 \
    php8-ctype \
    php8-curl \
    php8-fpm  \
    php8-dom \
    php8-gd \
    php8-intl \
    php8-json \
    php8-mbstring \
    php8-mysqli \
    php8-opcache \
    php8-openssl \
    php8-phar \
    php8-session \
    php8-xml \
    php8-xmlreader \
    php8-zlib \
    supervisor \
    tini \
    curl \
    tzdata \
    logrotate \
    dcron \
    libcap \
    && chown nobody:nobody /usr/sbin/crond \
    && setcap cap_setgid=ep /usr/sbin/crond \
    && mkdir -p /app /logs \
    && rm -rf /tmp/* \
    /var/{cache,log}/* \
    /etc/logrotate.d \
    /etc/crontabs/* \
    /etc/periodic/daily/logrotate

COPY rootfs /

RUN chown -R nobody:nobody /app \
    && chown -R nobody:nobody /logs \
    && chown -R nobody:nobody /run \
    && chown -R nobody:nobody /var/lib \
    && chown -R nobody:nobody /var/log/nginx \
    && chown -R nobody:nobody /etc/crontabs

USER nobody

WORKDIR /app

COPY --chown=nobody:nobody app /app

VOLUME "/logs"

EXPOSE 8080

ENTRYPOINT ["/usr/bin/docker-entrypoint.sh"]

ENTRYPOINT ["/sbin/tini", "--", "/usr/bin/docker-entrypoint.sh"]

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

HEALTHCHECK --timeout=15s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
