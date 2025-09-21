<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Superhéroe</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilo simple para la lista de sugerencias */
        #sugerencias {
            border: 1px solid #ccc;
            max-width: 300px;
            background: #fff;
            position: absolute;
            z-index: 1000;
        }
        #sugerencias div {
            padding: 5px;
            cursor: pointer;
        }
        #sugerencias div:hover {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>Buscar Superhéroe</h1>

    <form action="<?= site_url('reportes/buscar') ?>" method="get" target="_blank">
        <label for="nombre">Nombre del superhéroe:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ej. Batman" autocomplete="off" required>
        <button type="submit">Generar PDF</button>
    </form>

    <div id="sugerencias"></div>

    <script>
        $(document).ready(function() {
            $("#nombre").on("keyup", function() {
                let query = $(this).val();
                if (query.length >= 2) { 
                    $.getJSON("<?= site_url('reportes/autocomplete') ?>", { term: query }, function(data) {
                        let sugerencias = "";
                        data.forEach(function(item) {
                            sugerencias += "<div class='opcion'>" + item + "</div>";
                        });
                        $("#sugerencias").html(sugerencias).show();
                    });
                } else {
                    $("#sugerencias").hide();
                }
            });

            // Cuando el usuario hace clic en una sugerencia
            $(document).on("click", ".opcion", function() {
                $("#nombre").val($(this).text());
                $("#sugerencias").hide();
            });
        });
    </script>
</body>
</html>
