px">'+e.securityMsg+"</div>"},{type:"html",id:"pasteMsg",html:'<div style="white-space:normal;width:340px">'+e.pasteMsg+"</div>"},{type:"html",id:"editing_area",style:"width:100%;height:100%",html:"",focus:function(){var a=this.getInputElement(),
b=a.getFrameDocument().getBody();!b||b.isReadOnly()?a.setCustomData("pendingFocus",1):b.focus()},setup:function(){var a=this.getDialog(),b='<html dir="'+c.config.contentsLangDirection+'" lang="'+(c.config.contentsLanguage||c.langCode)+'"><head><style>body{margin:3px;height:95%}</style></head><body><script id="cke_actscrpt" type="text/javascript">window.parent.CKEDITOR.tools.callFunction('+CKEDITOR.tools.addFunction(h,a)+",this);<\/script></body></html>",f=CKEDITOR.env.air?"javascript:void(0)":CKEDITOR.env.ie?
"javascript:void((function(){"+encodeURIComponent("document.open();("+CKEDITOR.tools.fixDomain+")();document.close();")+'})())"':"",d=CKEDITOR.dom.element.createFromHtml('<iframe class="cke_pasteframe" frameborder="0"  allowTransparency="true" src="'+f+'" role="region" aria-label="'+e.pasteArea+'" aria-describedby="'+a.getContentElement("general","pasteMsg").domId+'" aria-multiple="true"></iframe>');d.on("load",function(a){a.removeListener();a=d.getFrameDocument();a.write(b);c.focusManager.add(a.getBody());
CKEDITOR.env.air&&h.call(this,a.getWindow().$)},a);d.setCustomData("dialog",a);a=this.getElement();a.setHtml("");a.append(d);if(CKEDITOR.env.ie){var g=CKEDITOR.dom.element.createFromHtml('<span tabindex="-1" style="position:absolute" role="presentation"></span>');g.on("focus",function(){setTimeout(function(){d.$.contentWindow.focus()})});a.append(g);this.focus=function(){g.focus();this.fire("focus")}}this.getInputElement=function(){return d};CKEDITOR.env.ie&&(a.setStyle("display","block"),a.setStyle("height",
d.$.offsetHeight+2+"px"))},commit:function(){var a=this.getDialog().getParentEditor(),b=this.getInputElement().getFrameDocument().getBody(),c=b.getBogus(),d;c&&c.remove();d=b.getHtml();setTimeout(function(){a.fire("pasteDialogCommit",d)},0)}}]}]}});