function ItemGrid(gridWrapperId, filterId){

    var self = this;
    var scrolling = false;
    this.items = [];
    this.count = 0;
    this.filter = {limit:8};

    var gridSelector = "#"+gridWrapperId;
    $(gridSelector).empty();

    var itemGrid = $(document.createElement("div"));
    itemGrid.prop("id", "itemgrid");
    itemGrid.prop("class", "row");

    $(gridSelector).append(itemGrid);

    this.dataProvider = new DataProvider(this);

    this.handleCharactersRequest = function(data){

        for (var i = 0; i < data.length; i++){

            var newItem = new Item(
                data[i].character_id,
                data[i].character_name,
                data[i].character_imagesrc,
                data[i].anime_name,
                data[i].character_mbti_type,"");

            this.items.push(newItem);
            newItem.render(itemGrid);

        }

        scrolling = true;
        self.count = self.items.length;

    }

    this.setAnimeFilter=function(value){

        this.filter.anime = value;
    }

    this.setNameFilter=function(value){

        this.filter.name = value;
    }

    this.setTypeFilter=function(value){

        if(value && value != "all"){
        }else
        {
            delete this.filter.type;
        }

        this.filter.type = value;
    }

    this.characterExists=function($id){

        for(var i = 0; i < self.items.length; i++){
            if(this.items[i].id == $id){

                return i;
            }
        }

        return -1;

    }

    this.loadCharacters = function(){

        var executed = false;

        if(self.items.length > 0){

            $(".grid-item-wrapper").fadeOut("fast", function(){

                $(".grid-item-wrapper").remove();

                if(!executed){
                    executed=true;
                    self.items = [];
                    self.dataProvider.getAllCharacters(SERVICES_PATH+SERVICE_URL_CHARACTER,self.filter);
                }
            });

        }
        else
        {

            self.dataProvider.getAllCharacters(SERVICES_PATH+SERVICE_URL_CHARACTER, self.filter);

        }

    }

    this.showDetailModal = function(alias){

        this.dataProvider.getCharacterByAlias(SERVICES_PATH+SERVICE_URL_CHARACTER,alias);



    }

    this.handleShowDetailModalRequest = function(data){

        var character = data.character[0];
        var characterItem = new Item(character.character_id, character.character_name, character.character_imagesrc, character.anime_name, character.character_mbti_type);


        var neightbors = this.getNeighborItemsById(characterItem.id);

        ItemDetailModal.open(characterItem,neightbors.previousItem, neightbors.nextItem, this.dataProvider);


    }

    this.getNeighborItemsById= function(id){

        var previousItem = null;
        var nextItem = null;

        for (var i = 0; i < this.items.length; i++){
            if(this.items[i].id == id){

                var previousIndex = i - 1;
                var nextIndex = i + 1;

                if(previousIndex < 0)
                    previousIndex = this.items.length - 1;

                if(nextIndex == this.items.length)
                    nextIndex = 0;

                previousItem = this.items[previousIndex];
                nextItem = this.items[nextIndex];

            }
        }

        return {previousItem: previousItem, nextItem: nextItem};


    }

    var filterSelector = "."+filterId;
    $(filterSelector).click(function(event){
        var menuItem = $(event.target);

        if(menuItem.prop("class")!="mbti_type active-filter"){
            $(".active-filter").prop("class","mbti_type");
            menuItem.prop("class", "mbti_type active-filter");
        }
    })

    $(".grid-searchform input").keyup(function(event){
        var inputElement = $(event.target);
        var value = inputElement.val();
        var filterType = inputElement.data("filter");

        var loadCharacter = true;

        switch (filterType)
        {
            case "anime":

                if(self.filter.anime == value)
                    loadCharacter = false;

                self.setAnimeFilter(value);
                break;
            case "name":

                if(self.filter.name == value)
                    loadCharacter = false;

                self.setNameFilter(value);
                break;
        }

        if(loadCharacter)
            self.loadCharacters();



    });


    $(window).scroll(function () {
        /*  if ($win.scrollTop() == 0)
         ///scrolled to page top*/
        if ($(window).height() + $(window).scrollTop() >= $(document).height() - 100 && scrolling) {
            
            var limit  = 4;
            var filterClone = $.extend({}, self.filter, {row_offset:self.count, limit:limit});
            self.dataProvider.getAllCharacters(SERVICES_PATH+SERVICE_URL_CHARACTER, filterClone);
            self.count+=limit;
        }
    });







}
