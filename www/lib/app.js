/**
 * Created by Mick on 5/29/15.
 */


    $(document).ready(function(){
        this.router = Router();
    });

    function Router(){

        this.routes = ["about-us"];
        this.previousPage = "";
        this.nextPage = "";


        this.executeRouter= function() {

            var currentUrl = document.location.href;
            var routeVariables = ((currentUrl.replace("#", "")).replace(SITE_URL, "")).split('/');
            routeVariables.splice(0, 1);

            if (routeVariables[0] == "character") {

                this.itemGrid.showDetailModal(routeVariables[1]);

            }
            else {

                if (!$("#itemgrid").length) {
                    this.itemGrid = new ItemGrid("itemgridwrapper", "mbti_type");
                }


                if(routeVariables[0] && checkForTypeFilter(routeVariables[0])){
                    this.itemGrid.setTypeFilter(routeVariables[0]);

                }else {

                    console.log("not in");

                    this.itemGrid.setTypeFilter();
                }
                this.itemGrid.loadCharacters();




            }




        }

        function checkForTypeFilter(routeVariable){

            for(var i = 0; i < mbtiTypes.length; i++){
                if(mbtiTypes[i].toUpperCase() == routeVariable.toUpperCase()){
                    return true;
                };
            }

            return false;
        }


        var self = this;
        var urlChanged = false;


        $(window).on('hashchange', function(event){
            event.preventDefault();
            urlChanged = true;
        });

        window.setInterval(function(){
            if(urlChanged){
                urlChanged = false;
                self.executeRouter();
            }
        }, 50);


        this.executeRouter();




    }

