/**
 * Created by Mick on 5/29/15.
 */

function DataProvider(itemGrid){
    this.itemGrid = itemGrid;


    var self = this;

    this.getAllCharacters = function(phpFile, filter) {
        var self = this;
        var parameters = {action:"getcharacters"};
        if(filter){
            parameters.filter = filter;
        }

            console.log(phpFile);


        $.getJSON(SITE_URL + phpFile, parameters, function(data){

            self.itemGrid.handleCharactersRequest(data.characters);
        });
    };

    this.getCharacterByAlias = function(phpFile, alias){

        var self = this;
        var parameters = {action:"getcharacterbyalias", character_alias:alias};

        $.getJSON(SITE_URL + phpFile, parameters, function(data){
            self.itemGrid.handleShowDetailModalRequest(data);
        });

    }

    this.getQuotesByCharacterId = function(phpFile, id, callback){

        var self = this;
        var parameters = {action:"getquotesbycharacterid", character_id:id};

        $.getJSON(SITE_URL + phpFile, parameters, callback);

    }

}
