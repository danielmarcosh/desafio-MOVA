# Desafio MOVA

## Linda da apresentação do Youtube 
https://youtu.be/0JkBmtGGjlI

### Comandos

- Levantar o Contêiner. OBS: se atente em estar na pasta raiz do projeto.
```bash
docker run --name hyperf \
-v ./:/data/project/hyperf-skeleton \
-p 9501:9501 \
--workdir /data/project/hyperf-skeleton -it --rm \
--privileged -u root \
--entrypoint /bin/sh \
hyperf/hyperf:8.2-alpine-v3.18-swoole
```

- Executar o servidor do Hyperf. OBS: se atente em estar na pasta raiz do projeto.
```bash
php bin/hyperf.php start
```