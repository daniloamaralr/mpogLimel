<html>
    <head>
        <meta charset="utf-8" />
        <title>MPOG - LIMEL</title>
        <link rel="stylesheet" href="tarefas.css" type="text/css" />
    </head>
</html>
    <body>
    <h1>Escolha Arquivo</h1>
        <form method="post" action="valores.php">
            <fieldset>
                <legend>Arquivo</legend>
                    <label>
                        Tarefa:
                        <input type="file" name="arq" id="arq" accept=".xls, .xlsx">
                    </label>
                    <input type="submit" value="Enviar" />
            </fieldset>
        </form>
    </body>

