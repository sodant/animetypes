function MultiFielder (className){

    this.id = className;
    this.mainInput = $(className);
    addDeleteEvent($(className).find("span"));
    this.setValues = function(values){

        clear();
        for(var i = 0; i < values.length; i++){
            var value = values[i].replace(/\\"/g, '"');
            createInput(value, true);


        }

    }

    $('.add-quote-button').click(function(){

        var lastValue = $(className).last().find("textarea").val();
        if(lastValue.length > 0){

            createInput("");

        }
    });


    function clear(){

        $(className).parent().find("textarea").first().val("");
        $(className).parent().find(".character-quote").first().siblings().remove();



    }

    function addDeleteEvent(element){
        element.click(function(){

            if($(className).size()>1){
                $(this).parent().parent().remove();
            }


        });
    }

    function createInput(value, prepend){

        var mainInput = $(className).last();
        var newInput = mainInput.clone();
        newInput.find("textarea").val(value);

        addDeleteEvent(newInput.find("span"));

        if(prepend){

            mainInput.before(newInput);
        }else{
            mainInput.after(newInput);
        }


    }






}