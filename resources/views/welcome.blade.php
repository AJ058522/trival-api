<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trival API</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">
                Trival API
            </h1>
            <p class="subtitle mt-1">
                API de busqueda unificada de los siguientes servicios:
            </p>
            <ol>
                <li>https://itunes.apple.com/search (canciones, películas, docs).</li>
                <li>http://www.tvmaze.com/api (shows de televisión).</li>
                <li>http://www.crcind.com/csp/samples/SOAP.Demo.cls (personas).</li>
            </ol>
            <p class="mt-2">Para realizar una busqueda sólo debes hacer una consulta GET a la siguiente URL http://127.0.0.1:8000/api/search?term=jack.</p>
            <p>El único parámetro de búsqueda es 'term'.</p>

            <p class="subtitle mt-2">
               En caso de que la consulta obtenga resultados recibirás un objeto similar al siguiente ejemplo:
            </p>

            <code>
            [
                {
                    "name": "100 Years",
                    "img": "https://is3-ssl.mzstatic.com/image/thumb/Music/v4/7b/17/3e/7b173e79-204e-6386-db17-d1ee42d784cb/source/30x30bb.jpg",
                    "type": "Canciones",
                    "source": "https://itunes.apple.com/"
                },
                {
                    "name": "11/22/63",
                    "img": "https://is4-ssl.mzstatic.com/image/thumb/Publication125/v4/d7/00/2a/d7002a8f-a00b-04a8-3904-b8dbfaf27f5c/source/60x60bb.jpg",
                    "type": "Documentos",
                    "source": "https://itunes.apple.com/"
                }
            ]
            </code>

            <p class="subtitle mt-2">
               De no haber coincidencias recibirás un Array vacío:
            </p>

            <code>[]</code>
        </div>
    </section>
</body>

</html>