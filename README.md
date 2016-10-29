#### Compiling the Protobuf

Run `make compile` within the docker container to compile the protobufs.

#### Quickstart

```
$ docker build .
$ docker run -v $(pwd):/var/www/html -i -t <container id> /bin/bash
```
