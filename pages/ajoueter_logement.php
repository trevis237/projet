<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/ajoueter_logement.css">
</head>
<body>
    <header>
        <h1>bienvenu</h1>
        <p>ce site vous aide a avoir une visibibilite sur vos bien immobilier afin de <br> faire croitre votre chiffre d'affaire et toucher un nombre important de personne dans le monde. <br> faites nous confince pour une experience palpitente et inoubliable</p>
    </header>
    <section class="corps">
        <form  method="post" enctype="multipart/form-data" action="../php/traiter_ajout_logement.php">
            <h1>ajouter un logement</h1>
            <div class="contain">
            <div class="champ">
                <label for="">nom</label><br>
                <input type="text" class="zone" name="nom" id="" placeholder="entrer le nom" required><br><br>
                <label for="">quartier</label><br>
                <input type="text" class="zone" name="adresse" id="" placeholder="entrer la localisation" required><br><br>
                <label for="">surface</label><br>
                <input type="text" class="zone" name="surface" id="" placeholder="entrer la surface" required><br><br>
                <label for="">prix</label><br>
                <input type="text" class="zone" name="prix" id="" placeholder="entrer le prix" required><br><br>
                <label for="">photo</label><br><br>
                <input type="file" name="photo" id=""><br><br>
            </div>
            <div class="champ top">
                <label for="">description</label><br>
                <textarea name="description" class="zone text" id="" placeholder="decrivez votre logement simplement" required></textarea><br><br>
                <label for="">ville</label><br>
                <input type="text" class="zone" name="ville" id="" placeholder="entrer la localisation" required><br><br>
                <label for="">code postal</label><br>
                <input type="text" class="zone" name="code_postal" id="" placeholder="entrer votre code postal" required><br><br>
                <label for="">type de logement</label><br><br>
                <input type="radio" name="nature" id="" value="appartement" checked>
                <label for="appqrtement">appartement</label><br><br>
                <input type="radio" name="nature" id="" value="studio" checked>
                <label for="studio">studio</label><br>
                <input type="submit" class="bouton" value="ajouter">
            </div><br>
            </div>
             
        </form>
    </section>
</body>
</html>