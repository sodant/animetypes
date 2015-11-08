<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    header('Location: index.php');
}

include("../../private/lib/data/MysqliAdapter.php");
include("../../private/config.php");
include("../../private/config/MysqlConfig.php");
$mysqlConfig = new \config\MysqlConfig(
    mysql_username,         //username
    mysql_password,             //password
    mysql_host,    //host
    mysql_database); //database
$mysqliAdapter = new \data\MysqliAdapter($mysqlConfig);
$characters = $mysqliAdapter->getAllCharacters(array(
    "limit" => 2147483647,
    "order" => "anime_name"));

$gridData = array();
$charactersWithoutAnime = array();
$anime = $mysqliAdapter->getAnime();
$specialCharacters = array('"', "'");
foreach($characters as $character){
    $quotes = $mysqliAdapter->getQuotesByCharacterId($character["character_id"]);
    $newQuotes = array();

    foreach($quotes as $quote){

        $newQuote = $quote["character_quote_value"];
        foreach($specialCharacters as $specialCharacter){
            $newQuote = str_replace($specialCharacter,'\"',$newQuote);
        }

        $newQuotes[] = $newQuote;

    }
    $newQuotes = array_map('utf8_encode', $newQuotes);

    $tempCharacter = $character;
    $tempCharacter["quotes"] = $newQuotes;
    if(isset($character["anime_id"])){

        $gridData[$character["anime_name"]][]= $tempCharacter;

    }else{

        $charactersWithoutAnime[] = $tempCharacter;
    }


}

$newGridData = array();

$newGridData["- No anime assigned"] = array("characters"=> $charactersWithoutAnime, "anime-id"=> -1);
foreach($anime as $entry){

    if(isset($gridData[$entry["anime_name"]])){

        $newGridData[$entry["anime_name"]] = array("characters" =>$gridData[$entry["anime_name"]], "anime-id" => $entry["anime_id"]);

    }else{

        $newGridData[$entry["anime_name"]] = array("characters" => array(),"anime-id" => $entry["anime_id"]);

    }
}


?>
<!DOCTYPE html>
<html lang="en" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" ng-app="animeTypes">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="images/favicon.png" type="image/png">

    <title>Anime-types.com</title>

    <link href="css/style.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="css/picedit.min.css" rel="stylesheet">


    <!-- App -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../lib/html5shiv.js"></script>
    <script src="../lib/respond.min.js"></script>


    <![endif]-->
</head>
<body>
<div class="topbar">
    <div class="menuwrapper">
    <div id="toolbar" class="btn-group" role="group" aria-label="Toolbar">
        <button class="btn btn-default" id="new-anime-button"><span class="glyphicon glyphicon-plus"></span> New anime</button>
        <button class="btn btn-default" id="new-character-button"><span class="glyphicon glyphicon-plus"></span> New character</button>
    </div>
    <a class="btn btn-default btn-block" id="logout-button" href="logout.php"><span class="glyphicon glyphicon-lock"></span>Logout</a>
    </div>
</div>
<div class="content">

    <div class="main-table-wrapper">
        <table class="table-striped main-table">
            <tr>
                <th>Anime name</th>
                <th style="width:60%">Characters</th>
                <th></th>
            </tr>
            <?php foreach($newGridData as $name => $data): ?>
                <?php $characters = $data["characters"]; ?>
            <tr>
                <td class="anime-name"><?php echo $name; ?>
                    <?php if($data["anime-id"] > 0):?>
                        - <a href="#" class="rename-anime-button" data-name="<?php echo $name;?>" data-id="<?php echo $data["anime-id"];?>">Rename</a>
                    <?php endif;?>
                </td>

                <td class="anime-characters"><span class="characters-counter" <?php if($data["anime-id"] < 0): ?>id="characters-no-anime-counter" <?php endif;?>><?php echo count($characters); ?></span> <span class="glyphicon glyphicon-user"></span> - <a href="#" class="show-characters-button">Show</a>
                    <table class="table-striped sub-table<?php if($data["anime-id"] < 0): ?> no-anime-table<?php endif;?>" style="display: none;">
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Total quotes</th>
                            <th></th>
                        </tr>
                        <?php foreach($characters as $character):?>

                        <tr class="character-row">
                            <td class="character-name"><?php echo $character["character_name"];?></td>
                            <td class="character-type"><?php echo $character["character_mbti_type"];?></td>
                            <td class="character-quotes"><?php echo count($character["quotes"]);?></td>
                            <td><span class="edit-character-button glyphicon glyphicon-edit"
                                   data-name='<?php echo $character["character_name"];?>'
                                   data-type='<?php echo $character["character_mbti_type"];?>'
                                   data-id='<?php echo $character["character_id"];?>'
                                      data-portrait='<?php echo $character['character_imagesrc']?>'
                                   data-anime='<?php echo $character["anime_id"];?>'
                                   data-quotes='<?php echo json_encode($character["quotes"])?>'></span>
                                <span class="glyphicon glyphicon-remove delete-button character-delete-button"
                                      data-id='<?php echo $character["character_id"];?>'></span>
                                <img class="delete-ajax-loader" src="img/ajax-loader.gif" style="visibility:hidden">
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                </td>
                <td>
                    <?php if($data["anime-id"] > 0): ?> <span data-id="<?php echo($data["anime-id"]);?>"  class="glyphicon glyphicon-remove delete-button anime-delete-button"></span><img class="delete-ajax-loader" src="img/ajax-loader.gif"  style="visibility:hidden"> <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

</div>


<footer>

</footer>


<!-- Modal edit character -->
<div class="modal fade" id="edit-character" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;" id="edit-character-title">Edit character</h4>
            </div>
            <div class="modal-body">
                <form id="edit-character-form" role="form" method="post" action="service/charactersave.php">
                    <table>
                        <tr>
                            <td class="portrait-holder-wrapper">
                                <div class="form-group portrait-holder">


                                </div>

                            </td>
                            <td class="details-holder-wrapper">
                                <div class="form-group">
                                    <label for="character-name"><span class="glyphicon glyphicon-user"></span> Name</label>
                                    <input name="character-name" type="text" class="form-control" id="character-name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Anime</label>
                                    <select type="text" class="form-control" id="character-anime" name="character-anime" placeholder="Select anime">
                                        <option value="-">-</option>
                                        <?php foreach($anime as $option): ?>
                                            <option value="<?php echo $option["anime_id"];?>"><?php echo $option["anime_name"];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="psw"><span class="glyphicon glyphicon-user"></span> Type</label>
                                    <select type="text" class="form-control" id="character-type" name="character-type" placeholder="Select Type">
                                        <option value="ENFJ">ENFJ</option>
                                        <option value="ENFP">ENFP</option>
                                        <option value="ENTJ">ENTJ</option>
                                        <option value="ENTP">ENTP</option>
                                        <option value="ESFJ">ESFJ</option>
                                        <option value="ESFP">ESFP</option>
                                        <option value="ESTJ">ESTJ</option>
                                        <option value="ESTP">ESTP</option>
                                        <option value="INFJ">INFJ</option>
                                        <option value="INFP">INFP</option>
                                        <option value="INTJ">INTJ</option>
                                        <option value="INTP">INTP</option>
                                        <option value="ISFJ">ISFJ</option>
                                        <option value="ISFP">ISFP</option>
                                        <option value="ISTJ">ISTJ</option>
                                        <option value="ISTP">ISTP</option>
                                    </select>
                                </div>

                            </td>
                        </tr>
                    </table>



                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-user"></span> Quotes</label>
                        <table class="characte-quote-table">
                            <tr class="character-quote">

                                <td><textarea name="character-quotes[]" placeholder="Enter quote" class="form-control" rows="2" id="comment"></textarea></td>
                                <td><span class="glyphicon glyphicon-remove delete-button"></span></td></tr>
                            </tr>

                        </table>
                        <span class="glyphicon glyphicon-plus add-quote-button"></span>
                    </div>

                    <input type="text" id="character-id" name="character-id" style="display:none">
                    <button type="submit" id="save-character-button" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-ok"></span> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="original-portrait-htmlholder" style="display:none">
    <label for="character-portrait"><span class="glyphicon glyphicon-user"></span> Portrait</label>
    <div class="image-editor">
        <input type="file" name="character-portrait" class="cropit-image-input">
        <div class="cropit-image-preview"></div>
        <div class="image-size-label">
            Resize image
        </div>
        <input type="range" class="cropit-image-zoom-input">
        <input type="hidden" name="image-data" class="hidden-image-data" />
    </div>
</div>


<!-- Modal edit anime -->
<div class="modal fade" id="edit-anime" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:red;" id="edit-anime-title">Edit anime</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="edit-anime-form" action="service/animesave.php" method="post">
                    <div class="form-group">
                        <label for="anime-name"><span class="glyphicon glyphicon-user"></span> Name</label>
                        <input name="anime-name" type="text" class="form-control" id="anime-name" placeholder="Enter anime name">
                    </div>
                    <input type="text" id="anime-id" name="anime-id" style="display:none">
                    <button type="submit" class="btn btn-default btn-success btn-block" id="save-anime-button"><span class="glyphicon glyphicon-ok"></span> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit anime -->
<div class="modal fade" id="confirm-delete" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                Are you sure that you want to delete this row?
            </div>
            <div class="modal-body">
                <div id="toolbar" class="btn-group" role="group" aria-label="Toolbar">
                    <button class="btn btn-danger" id="confirm-delete-button"><span class="glyphicon glyphicon-remove"></span> Confirm</button>
                    <button class="btn btn-default" data-dismiss="modal"> Cancel</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="white-background">
    <img class="refresh-ajax-loader" src="img/ajax-loader-large.gif" >

</div>



<script src="../lib/jquery-1.11.1.min.js"></script>
<script src="../lib/jquery-migrate-1.2.1.min.js"></script>
<script src="../lib/bootstrap.min.js"></script>
<!-- Components -->
<script src="js/MultiFielder.js"></script>
<script src="js/jquery.cropit.js"></script>
<script>

    var editCharacterMultiFielder = new MultiFielder(".character-quote");

    $(".show-characters-button").click(function(event){
        var target = $(event.target);
        target.next().toggle();
        if(target.text() == "Show"){

            target.text("Hide");
        }else{
            target.text("Show");
        }
    });

    $(".edit-character-button").click(function(event){
        var target = $(event.target);

        var id = target.data("id")
        var name = target.data("name");
        var type = target.data("type");
        var anime = target.data("anime");
        var quotesRaw = target.data("quotes");
        var portrait = target.data("portrait");

        if(!anime){
            anime="-";
        }


        var quotes = new Array();
        for(var i = 0; i < quotesRaw.length; i++) {
            var quote = quotesRaw[i];
            quotes.push(quote);
        }
        editCharacterMultiFielder.setValues(quotes);
        $("#edit-character-title").text("Edit character");
        $("#character-name").val(name);
        $("#character-type").val(type);
        $("#character-anime").val(anime);
        $("#character-id").val(id);

        $(".portrait-holder").empty();
        $(".portrait-holder").append($("#original-portrait-htmlholder").clone().html());
        var src = "../media/images/characters/" + portrait;
        $(".portrait-holder").find('.image-editor').cropit({ imageState: { src:src, imageBackground: true }});
        $("#edit-character").modal();



    });

    $("#new-character-button").click(function(event){
        var target = $(event.target);

        editCharacterMultiFielder.setValues(new Array());
        $("#edit-character-title").text("New character");
        $("#character-name").val("");
        $("#character-type").val("ENFJ");
        $("#character-anime").val("-");
        $("#character-id").val("-1");

        $(".portrait-holder").empty();
        $(".portrait-holder").append($("#original-portrait-htmlholder").clone().html());

        $(".portrait-holder").find('.image-editor').cropit({ imageState: {imageBackground: true }});
        $("#edit-character").modal();



    });

    $(".rename-anime-button").click(function(event){
        var target = $(event.target);

        var name = target.data("name");
        var id = target.data("id");

        $("#anime-id").val(id);
        $("#anime-name").val(name);

        $("#edit-anime-title").text("Edit anime");

        $("#edit-anime").modal();


    });

    $("#new-anime-button").click(function(event){
        var target = $(event.target);
        $("#anime-id").val("-1");
        $("#anime-name").val("");
        $("#edit-anime-title").text("New anime");

        $("#edit-anime").modal();


    });

    $(".character-delete-button").click(function(event){

        var target = $(event.target);
        var id = target.data("id");


        $("#confirm-delete").modal();

        $("#confirm-delete-button").unbind("click");
        $("#confirm-delete-button").click(function(){
            $("#confirm-delete").modal('hide');
            target.parent().find(".delete-ajax-loader").css({visibility:"visible"});
            $.post( "service/characterdelete.php",{id:id}, function( data ) {
                var counter = target.parent()//td
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .find(".characters-counter");//tr
                console.log(counter.text());



                var count = counter.text();
                count--;
                counter.text(count);

                target.parent().parent().remove();



            });
        });

    });

    $(".anime-delete-button").click(function(event){

        var target = $(event.target);
        var id = target.data("id");
        $("#confirm-delete").modal();
        var table = target.parent().parent();

        $("#confirm-delete-button").unbind("click");
        $("#confirm-delete-button").click(function(){
            $("#confirm-delete").modal('hide');
            target.parent().find(".delete-ajax-loader").css({visibility:"visible"});
            $.post( "service/animedelete.php",{id:id}, function( data ) {


                var rows = table.children().find(".character-row");
                $(".no-anime-table").append(rows);
                var newCount =  parseInt($("#characters-no-anime-counter").text(), 10) + rows.size();
                $("#characters-no-anime-counter").text(newCount)
                target.parent().parent().remove();



            });
        });





    });

    $("#save-character-button").click(function(event){

        event.preventDefault();

        $('#edit-character-form').submit(function() {
            // Move cropped image data to hidden input
            var imageData = $('.image-editor').cropit('export');
            $('.hidden-image-data').val(imageData);

            // Print HTTP request params
            var formValue = $(this).serialize();
            var data = $('#edit-character-form').serialize()

            $.ajax({
                url: "service/charactersave.php",
                type: "POST",
                data: data,
                success: function (data) {
                    location.reload();
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            }); // AJAX Get Jquery statment


            // Prevent the form from actually submitting
            return false;

        });

        $('#edit-character-form').submit();

    });

    $("#save-anime-button").click(function(event){

        event.preventDefault();

        $('#edit-anime-form').submit(function() {
            // Print HTTP request params
            var data = $('#edit-anime-form').serialize()

            $.ajax({
                url: "service/animesave.php",
                type: "POST",
                data: data,
                success: function (data) {
                    location.reload();
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            }); // AJAX Get Jquery statment


            // Prevent the form from actually submitting
            return false;

        });

        $('#edit-anime-form').submit();




    });

    var $window = $(window).on('resize', function(){
        var height = $(document).height();
        $(".main-table-wrapper").height(height);
    }).trigger('resize'); //on page load



</script>



</body>
</html>