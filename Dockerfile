FROM ubuntu:xenial
MAINTAINER Ricardo Velhote "rvelhote+github@gmail.com"

ENV DEBIAN_FRONTEND noninteractive

# TODO For development I prefer to have the commands split. Increases the image size but makes corrections faster.
RUN apt-get update && apt-get -y upgrade && apt-get -y dist-upgrade
RUN apt-get install -y --no-install-recommends php7.0-cli php7.0-xml php-xdebug openssh-server ca-certificates

RUN mkdir /var/run/sshd
RUN echo 'root:screencast' | chpasswd
RUN sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config

# SSH login fix. Otherwise user is kicked off after login
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd

ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

EXPOSE 22
CMD ["/usr/sbin/sshd", "-D"]