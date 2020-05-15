FROM mysql:8.0.18
ARG MYCONF
RUN rm -f /etc/mysql/conf.d/mysqldump.cnf
COPY my.cnf /etc/mysql/conf.d/
COPY ${MYCONF} /etc/mysql/conf.d/
