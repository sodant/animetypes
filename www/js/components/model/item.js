/**
 * Created by Mick on 5/29/15.
 */


function Item(id, name, image, anime, type){


    this.id = id;
    this.name = name;
    this.image = image;
    this.anime = anime;
    this.type = type;
    this.alias = this.name.replace(/ /g, "-").toLowerCase();

    this.domId = "character-" + this.id
    this.selector = "#" + this.domId;

    this.hide = function(){
        $(this.selector).css({
            display: "none",
            visibility: "hidden"
        });
    }

    this.show = function(){


        $(this.selector).css({
            display: "block",
            visibility: "visible"
        });

    }


    this.render = function(wrapper){

        var gridNameLabel = $(document.createElement("label"));
        gridNameLabel.prop("class", "name")
        gridNameLabel.append($(document.createTextNode(this.name)));

        var gridTypeLabel = $(document.createElement("label"));
        gridTypeLabel.prop("class", "type")
        gridTypeLabel.append($(document.createTextNode(this.type)));

        var animeLabel = $(document.createElement("label"));
        animeLabel.prop("class", "anime")
        animeLabel.append($(document.createTextNode(this.anime)));

        var gridDetail= $(document.createElement("div"));
        gridDetail.prop("class","grid-detail");
        gridDetail.append(gridNameLabel);
        gridDetail.append(gridTypeLabel);
        gridDetail.append(animeLabel);


        var gridItem= $(document.createElement("a"));
        gridItem.prop("class","grid-item");
        gridItem.prop("id", this.domId);
        gridItem.prop("href", "#character/"+this.alias);

        var imageUrl = "../media/images/characters/"+this.image;
        var imageBackground = "#151a22 url('"+imageUrl+"') no-repeat";

        gridItem.css({display: "none"});
        gridItem.data("type", this.type);

        gridItem.append(gridDetail);

        var column= $(document.createElement("div"));
        column.prop("class","col-md-3 grid-item-wrapper");
        column.append(gridItem);

        var id = "#"+id;
        $(wrapper).append(column);
        gridItem.fadeIn();
        PreloadImage(imageUrl, function(){
            gridItem.css({"background": imageBackground, "background-position":"center", "background-size":"cover"});

            //$(gridItem).fadeIn("fast");
        });




    }

    function PreloadImage(imgSrc, callback){
        var objImagePreloader = new Image();

        objImagePreloader.src = imgSrc;
        if(objImagePreloader.complete){
            callback();
            objImagePreloader.onload=function(){};
        }
        else{
            objImagePreloader.onload = function() {
                callback();
                //    clear onLoad, IE behaves irratically with animated gifs otherwise
                objImagePreloader.onload=function(){};
            }
        }
    }




}
