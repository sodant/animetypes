/**
 * Created by Mick on 5/31/15.
 */

var ItemDetailModal = {

    self : this,

    getViewport : function() {
    var $w = $(window);
    return {
        l: $w.scrollLeft(),
        t: $w.scrollTop(),
        w: $w.width(),
        h: $w.height()
    }
    },
    open:function(gridItem, previousGridItem, nextGridItem, dataprovider){
            $(".item-detail").remove();
            $(".item-detail-background").remove();
            $(".tooltip").remove();


            var title = $(document.createElement("h2"));
            title.prop("class", "item-detail-title");
            title.append($(document.createTextNode(gridItem.name)));

            var imageBackground = "url('../media/images/characters/"+gridItem.image+"')";

            var profilePic = $(document.createElement("div"));
            profilePic.prop("class", "profile-pic");
            profilePic.css({height:"40%", width:"49%", "background-image":imageBackground});

            var quotesContainer = $(document.createElement("ul"));
            quotesContainer.prop("class", "quotes-container");
            quotesContainer.css({"min-height":"40%", width:"49%"});

            var row1Cell1 = $(document.createElement("td"));
            row1Cell1.append($(document.createTextNode("Type:")));
            var row1Cell2 = $(document.createElement("td"));
            row1Cell2.append($(document.createTextNode(gridItem.type)));

            var row1 = $(document.createElement("tr"));
            row1.append(row1Cell1);
            row1.append(row1Cell2);

            var row2Cell1 = $(document.createElement("td"));
            row2Cell1.append($(document.createTextNode("Anime:")));
            var row2Cell2 = $(document.createElement("td"));
            row2Cell2.append($(document.createTextNode(gridItem.anime)));

            var row2 = $(document.createElement("tr"));
            row2.append(row2Cell1);
            row2.append(row2Cell2);

            var profileInfo = $(document.createElement("table"));
            profileInfo.prop("class", "profile-info");
            profileInfo.append(row1);
            profileInfo.append(row2);
            profileInfo.css({width:"100%"});

            var infoWrapper = $(document.createElement("div"));
            infoWrapper.prop("class", "profile-info-wrapper");
            infoWrapper.css({width:"49%", height:"40%"});
            infoWrapper.append(profileInfo);

            var itemDetailContent = $(document.createElement("div"));
            itemDetailContent.prop("class", "detail-content");
            itemDetailContent.css({height:"93%", width:"100%"});

            itemDetailContent.append(profilePic);
            itemDetailContent.append(infoWrapper);
            itemDetailContent.append(quotesContainer);


            var previousCharacterLink = $(document.createElement("a"));
            previousCharacterLink.prop("href", "#characters/"+previousGridItem.alias);


            var previousCharacterButton = $(document.createElement("i"));
            previousCharacterButton.prop("title", previousGridItem.name + " - " + previousGridItem.type);
            previousCharacterButton.prop("class", "fa fa-arrow-circle-left item-previous");
            previousCharacterButton.data("placement", "auto bottom");
            previousCharacterButton.data("toggle", "tooltip");

            previousCharacterLink.append(previousCharacterButton);


            var nextCharacterLink = $(document.createElement("a"));;
            nextCharacterLink.prop("href", "#characters/"+nextGridItem.alias);


            var nextCharacterButton = $(document.createElement("i"));
            nextCharacterButton.prop("title", nextGridItem.name + " - " + nextGridItem.type);
            nextCharacterButton.prop("class", "fa fa-arrow-circle-right item-next");
            nextCharacterButton.data("placement", "auto bottom");
            nextCharacterButton.data("toggle", "tooltip");

            nextCharacterLink.append(nextCharacterButton);

            var itemDetail = $(document.createElement("section"));
            itemDetail.prop("class", "item-detail");
            itemDetail.append(previousCharacterLink);
            itemDetail.append(title);
            itemDetail.append(nextCharacterLink);
            itemDetail.append(itemDetailContent);

            var background = $(document.createElement("div"));
            background.prop("class", "item-detail-background");

            $("body").append(itemDetail);
            $("body").append(background);
            jQuery('.item-previous').tooltip({container:"body"});
            jQuery('.item-next').tooltip({container:"body"});

            var self = this;
            background.click(function(){
                self.close();
            });

            $( window ).resize(function(){
                self.resize();
            });

            /**
            $('html, body').css({
                'overflow': 'hidden',
                'height': '100%'
            });
             **/
            this.resize();

            dataprovider.getQuotesByCharacterId(SERVICES_PATH+SERVICE_URL_CHARACTER, gridItem.id, function(data){
                var quotes = data.quotes;

                for (var i = 0; i < quotes.length; i++){

                    var quote = quotes[i];

                    var leftQuote = $(document.createElement("i"));
                    leftQuote.prop("class", "fa fa-quote-left");
                    var rightQuote = $(document.createElement("i"));
                    rightQuote.prop("class", "fa fa-quote-right");

                    var listItem = $(document.createElement("li"));
                    listItem.append(leftQuote);
                    listItem.append($(document.createTextNode(quote.character_quote_value)));
                    listItem.append(rightQuote);
                    listItem.prop("class", "quote");


                    $(".quotes-container").append(listItem);


                }

            });




    },
    close:function(){
        $(".item-detail").remove();
        $(".item-detail-background").remove();

        if(history.pushState) {
            history.pushState(null, null, '#characters');
        }
        else {
            location.hash = '#';
        }

    },
    resize:function(){

        //var modalWindowHeight = ($(window).innerWidth() / 100) * 40;
        var modalWindowTop = ($(window).innerHeight() / 100);
        var modalWindowLeft = (($(window).innerWidth()- $(".item-detail").width()) / 2);
        var itemDetailCss = {top:modalWindowTop, left:modalWindowLeft};

        $(".item-detail-background").css({height: $(window).height()});
        $(".item-detail").css(itemDetailCss);

        var detailContentHeight = ($(".item-detail").innerHeight() - $('.item-detail-title').height())-20;

        $(".item-detail .detail-content").css({height:detailContentHeight, width:"100%"});





    }

}
