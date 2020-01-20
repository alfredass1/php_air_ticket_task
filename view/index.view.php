<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="view/css/style.css">
</head>

<?php

if (isset($_POST['submit'])) {
    if (!preg_match('/\w{1,100}$/',
        trim(htmlspecialchars($_POST['name'])))) {
        $validac_klaidos[] = "<h6>Vardas turi būti ne trumpesnis negu 1 bei neilgesnis negu 100 simboliu</h6>";
    }

    if (!preg_match('/\w{1,100}$/',
        trim(htmlspecialchars($_POST['lastname'])))) {
        $validac_klaidos[] = "<br><h6>Pavarde turi būti ne trumpesne negu 1 bei neilgesne negu 100 simboliu</h6>";
    }

    if (!preg_match('/^([3-6]\d{10})$/',
        trim(htmlspecialchars($_POST['personalCode'])))) {
        $validac_klaidos[] = "<br><h6>Asmens kodo netinkamas formatas</h6>";
    }

    if (!preg_match('/[\w\s{50,1000}]/i',
        trim(htmlspecialchars($_POST['notes'])))) {
        $validac_klaidos[] = "<br><h6>Netinkamas pastabos formatas</h6>";
    }
    if (!isset($_POST['flyNr'])) {
        $validac_klaidos[] = "<br><h6>Skrydzio numeris turi buti ivestas</h6>";
    }
    if (!isset($_POST['weight'])) {
        $validac_klaidos[] = "<br><h6>Bagazo svoris turi buti ivestas</h6>";
    }


    $kaina = $_POST['price'];
    $bag = $_POST['weight'];
    $bagKain = 0;
    if ($bag >= 20) {
        ($kain = $kaina + 30) and ($bagKain = $bagKain + 30);
    }

    $skrydzNr = $_POST['flyNr'];
    $vardas = $_POST['name'];
    $pavarde = $_POST['lastname'];
    $asmKod = $_POST['personalCode'];
    $kryptisIs = $_POST['directionFrom'];
    $kryptisI = $_POST['directionTo'];
    $isViso = $kain * 1;
    $pastabos = $_POST['notes'];

}


?>


<?php

$skrydzioNr = ['10', '20', '30', '40', '50'];
$isKur = ['Vilnius', 'Kaunas', 'Palanga', 'Ryga', 'Talinas'];
$iKur = ['Vilnius', 'Kaunas', 'Palanga', 'Ryga', 'Talinas'];
$bagazas = ['2', '5', '10', '15', '20', '25', '30'];

?>

<?php if ($validac_klaidos): ?>
    <div class="klaidos">
        <ul>
            <?php foreach ($validac_klaidos as $klaida): ?>
                <?= $klaida; ?>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>

<body>
<h1><?= siteName; ?></h1>
<div class="container">

    <form method="post">
        <div class="form-group">
            <label for="exampleInput">Skrydžio nr</label>
            <select name="flyNr" id="" class="form-control">
                <option selected disabled>--Pasirinkite--</option>
                <?php foreach ($skrydzioNr as $nr): ?>
                    <option value="<?= $nr ?>"><?= $nr ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="form-group">
            <label for="exampleInput">Asmens kodas</label>
            <input type="number" class="form-control" id="" name="personalCode">
        </div>
        <div class="form-group">
            <label for="exampleInput">Vardas</label>
            <input type="text" class="form-control" id="" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInput">Pavardė</label>
            <input type="text" class="form-control" id="" name="lastname">
        </div>
        <div class="form-group">
            <label for="exampleInput">Iš kur skrendate</label>
            <select name="directionFrom" class="form-control">
                <option selected disabled>--Pasirinkite--</option>
                <?php foreach ($isKur as $iSnr): ?>
                    <option value="<?= $iSnr ?>"><?= $iSnr ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInput">Į kur skrendate</label>
            <select name="directionTo" name="direction" class="form-control">
                <option selected disabled>--Pasirinkite--</option>
                <?php foreach ($iKur as $inr): ?>
                    <option value="<?= $inr ?>"><?= $inr ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInput">Kaina</label>
            <input type="number" class="form-control" name="price">
        </div>

        <div class="form-group">
            <label for="exampleInput">Bagažas</label>
            <select name="weight" id="weight" class="form-control">
                <option selected disabled>--Pasirinkite--</option>
                <?php foreach ($bagazas as $bagaz): ?>
                    <option value="<?= $bagaz ?>"><?= $bagaz ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInput">Pastabos</label>
            <textarea class="form-control" name="notes" id="" rows="3"></textarea>
        </div>


        <button type="submit" class="btn btn-primary" name="submit">Siųsti</button>


        <button type="button" name="submit" class="btn btn-primary" data-toggle="modal" data-target="#ticket">
            Spausdinti bilietą
        </button>

    </form>

    <div class="modal fade" id="ticket" tabindex="1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bilieto spausdinimas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body body">
                    <div class="container tickets">
                        <div class="row Head">
                            <h3>Bilietas</h3>
                        </div>
                        <div class="row ticketas">
                            <div class="col mainInfos">
                                <div class="col-md nr">Skrydzio Numeris<p><?= $skrydzNr; ?></p></div>
                                <div class="col-md i">Skrydis Į<p><?= $kryptisI ?></p></div>
                                <div class="col-md is">Skrydis Iš<p><?= $kryptisIs ?></p></div>
                            </div>
                        </div>
                            <div class="row personal">
                                <div class="col mainInfo1">
                                    <div class="col-md-6 var">Vardas<p><?= $vardas; ?></p></div>
                                    <div class="col-md pav">Pavarde<p><?= $pavarde; ?></p></div>
                                    <div class="col-md-0 asm">Asmens kodas<p><?= $asmKod; ?></p></div>
                                </div>
                                    <div class="col mainInfo2">
                                        <div class="col-md ">Bilieto kaina<p><?= $kaina; ?> €</p></div>
                                        <div class="col-md">Bagazo kaina<p><?= $bagKain; ?> €</p></div>
                                        <div class="col-md pric">Galutine kaina<h4><?= $isViso; ?> €</h4></div>
                                        <div class="col-md">Pastabos:<p><?= $pastabos; ?></p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>