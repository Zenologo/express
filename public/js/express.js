var myFacets;


$(function(){

	
	
	function calculePoinds(){

		var poinds = $("#colis-poinds-prevu").val();
		var assurence = $("#colis-assurance").val();
		var depot_mode = $("#depot-mode").val();
		
		// vo: 普通客户； v1: 普通会员; v2: 白金会员
		var vip = $('table.recommand').attr('id');
		$r = poinds.substr(0, poinds.indexOf('kg'));
		$col = 7;
		
		if (depot_mode == 'sur_place')
		{
			$col = 3;
		}else{
			if (vip == 'v0'){
				$col = 7;
			}else if (vip == 'v1'){
				 $col = 1;
			}else if (vip == 'v2') {
				$col = 2;
			}
		}
		
		switch ($r)
		{
			case '15':$r = '11'; break;
			case '20': $r = '12'; break;
			case '25':$r = '13'; break;
			case '30': $r = '14'; break;
		}
		
		var total = (document.getElementById('prix').rows[$r].cells[$col].innerText);
		
		if (0 != assurence && 0 != poinds)
			total = parseInt(total) + parseInt(assurence);
		var valeur = "0€";
		if (0 != total)
			valeur = total + "€";

		$("#colis-total").text(valeur);
	};
	
	

	function autocompeteDes(dest){
		$('#userAds tr').each(function() {
		    var tmp = $(this).find("#nom").text();
		    
		    var data = [];
		    data.push(tmp);
		    
		    
		     tmp = $(this).find("#tel").text();
			 data.push(tmp);
			 
			 tmp = $(this).find("#zip").text();
			 data.push(tmp);
			 
			 tmp = $(this).find("#ads").text();
			 data.push(tmp);
			 
			 tmp = $(this).find("#ville").text();
			 data.push(tmp);
			 
			 dest.push(data);
			 data = [];
		    
		 });	
	}
	
	
	function autocompeteExp(exp){
		$('#userExpAds tr').each(function() {
		    var tmp = $(this).find("#nom").text();
		    
		    var data = [];
		    data.push(tmp);
		    
		    
		     tmp = $(this).find("#tel").text();
			 data.push(tmp);
			 
			 tmp = $(this).find("#zip").text();
			 data.push(tmp);
			 
			 tmp = $(this).find("#ads").text();
			 data.push(tmp);
			 
			 tmp = $(this).find("#ville").text();
			 data.push(tmp);
			 
			 exp.push(data);
			 data = [];
		    
		 });	
	}
	
	
	


	myFacets = {
        
		init: function() {
			calculePoinds();

		},

		calculePoinds: function(){
			calculePoinds();
		}
	};
	
	var admin_colis_table = $("#colis-list").DataTable({
		"language": {
            "lengthMenu": "每而显示 _MENU_ 条记录",
            "zeroRecords": "没有记录",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
		},
		"drawCallback": function (settings) {
    		var api = this.api();      		
    		 $("#parcel_assurance").html(api.column(16, {search:'applied'}).data().sum());
    		 $("#transport_frais").html(api.column(17, {search:'applied'}).data().sum());
    		 $("#transport_frais_final").html(api.column(21, {search:'applied'}).data().sum());
          },
    	"order": [[ 18, "desc" ]]
	});
	
	$('#colis-list tbody').on( 'click', 'button#delegation', function () {
        var data = admin_colis_table.row($(this).parents('tr') ).data();
        
        var link = "/admin/print/" + data[22];
        location.href = link;
    } );
	
	$('#colis-list th:eq(0)').css("width", "10px");
	

	/* Formatting function for row details - modify as you need */
	function admin_colis_format (d) {
	    // `d` is the original data object for the row
	    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
	        '<tr>'+
	            '<td>发件人信息:</td>'+
	            '<td>' + d[3] + '<br>' + d[6] + '<br>' + d[7] + ', ' + d[8] + '<br>'+ d[5]  + '</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>收件人信息:</td>'+
	            '<td>' + d[9] + '<br>' + d[10] + '<br>' + d[12] + ', ' + d[11] + '<br>' + d[13] + ' ' + d[14]  + '<br>' + '</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>包裹信息:</td>'+
	            '<td>' + d[1] + '</td>'+
	        '</tr>'+
	    '</table>';
	}
	
	// Add event listener for opening and closing details
    $("#colis-list tbody").on("click", "td.details-control", function(){
        var tr = $(this).closest('tr');
        var row = admin_colis_table.row(tr);
            	
        if (row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(admin_colis_format(row.data())).show();
            tr.addClass('shown');
        }
    } );

    // 客户包裹清单表格 id=client_colis_table
	var client_colis_table = $("#client-colis-list").DataTable({
		"language": {
            "lengthMenu": "每页显示 _MENU_ 条记录",
            "zeroRecords": "没有记录",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "没有找到匹配记录",
            "infoFiltered": "(filtered from _MAX_ total records)"
		},
		"drawCallback": function (settings) {
    		var api = this.api();      		
    		 $(".post_frais").html(api.column(14, {search:'applied'}).data().sum());
    		 $(".assurance_frais").html(api.column(15, {search:'applied'}).data().sum());
          },
  	    "order": [[ 16, "desc" ]],
	});

	$('#client-colis-list_wrapper').css("width", "1100px");
	$('#client-colis-list_wrapper').css("margin-left", "auto");
	$('#client-colis-list_wrapper').css("margin-right", "auto");
	$('#client-colis-list th:eq(0)').css("width", "10px");
	
	
	// 会员包裹列表隐藏格式 
	function user_colis_format(d) {
	    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
	        '<tr>'+
	            '<td>发件人信息:</td>'+
	            '<td>' + d[1] + '<br>' + d[2] + ', ' + d[3] + ' ' + d[4] + '<br>' + d[5] + '</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>收件人信息:</td>'+
	            '<td>' + d[7] + '<br>' + d[8] + ', ' + d[9] + ' ' + d[10] + ' ' + d[12] + '<br>' + d[11] + '</td>'+
	        '</tr>'+
//	        '<tr>'+
//	            '<td>包裹信息:</td>'+
//	            '<td>' + d[3] + '</td>'+
//	        '</tr>'+
	    '</table>';
	}
	
	// Add event listener for opening and closing details
    $("#client-colis-list tbody").on("click", "td.details-control", function(){
        var tr = $(this).closest('tr');
        var row = client_colis_table.row(tr);

        if (row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(user_colis_format(row.data())).show();
            tr.addClass('shown');

        }
    } );

  
	
    
    var table = $("#commande-colis-list").DataTable({
		"language": {
            "lengthMenu": "每页显示 _MENU_ 条记录",
            "zeroRecords": "没有记录",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "没有找到匹配记录",
            "infoFiltered": "(filtered from _MAX_ total records)"
		}
	});

	$('#commande-colis-list_wrapper').css("width", "1100px");
	$('#commande-colis-list_wrapper').css("margin-left", "auto");
	$('#commande-colis-list_wrapper').css("margin-right", "auto");
	$('#commande-colis-list th:eq(0)').css("width", "10px");
	
	
	// 会员包裹列表隐藏格式 
	function commande_colis_format(d) {
	    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
	        '<tr>'+
	            '<td>发件人信息:</td>'+
	            '<td>' + d[1] + '<br>' + d[2] + ', ' + d[3] + ' ' + d[4] + '<br>' + d[5] + '</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>收件人信息:</td>'+
	            '<td>' + d[7] + '<br>' + d[8] + ', ' + d[9] + ' ' + d[10] + ' ' + d[12] + '<br>' + d[11] + '</td>'+
	        '</tr>'+
//	        '<tr>'+
//	            '<td>包裹信息:</td>'+
//	            '<td>' + d[3] + '</td>'+
//	        '</tr>'+
	    '</table>';
	}
	
	// Add event listener for opening and closing details
    $("#commande-colis-list tbody").on("click", "td.details-control", function(){
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(commande_colis_format(row.data())).show();
            tr.addClass('shown');

        }
    } );

    
    $('.etiquette').click(function() {
        alert("wait...");
    });
    
    
	
	// 管理员包裹日期查询
	 $('#admin-colis-date-debut').datepicker({
		 dateFormat: "yy-mm-dd"
	 });
	 $('#admin-colis-date-fin').datepicker({
		 dateFormat:"yy-mm-dd"
	 });

	 // 管理员需要下单包裹日期查询
	 $('#commande-colis-date-debut').datepicker({
		 dateFormat: "yy-mm-dd"
	 });
	 $('#commande-colis-date-fin').datepicker({
		 dateFormat:"yy-mm-dd"
	 });
	 
	 // 会员包裹日期查询
	 $('#client-colis-date-debut').datepicker({
		 dateFormat: "yy-mm-dd"
	 });
	 $('#client-colis-date-fin').datepicker({
		 dateFormat:"yy-mm-dd"
	 });
	 
	 
	 
	 (function comboboxDest ( $ ) {
		    $.widget( "custom.comboboxDest", {
		      _create: function() {
		        this.wrapper = $( "<span>" )
		          .addClass( "dest_com_combobox" )
		          .insertAfter( this.element );
		 
		        this.element.hide();
		        this._createAutocomplete();
		        this._createShowAllButton();
		      },
		 
		      _createAutocomplete: function() {
		        var selected = this.element.children( ":selected" ),
		          value = selected.val() ? selected.text() : "";
		 
		        this.input = $( "<input>" )
		          .appendTo( this.wrapper )
		          .val( value )
		          .attr( "title", "" )
		          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
		          .attr("id", "combobox-dest-nom")
		          .autocomplete({
		            delay: 0,
		            minLength: 0,
		            source: $.proxy( this, "_source" )
		          })
		          .tooltip({
//		            tooltipClass: "ui-state-highlight"
		          });
		 
		        this._on( this.input, {
		          autocompleteselect: function( event, ui ) {
		            ui.item.option.selected = true;
		            this._trigger( "select", event, {
		              item: ui.item.option
		            });
		          },
		 
		          autocompletechange: "_removeIfInvalid",
		        });
		      },		        
		      _createShowAllButton: function() {
		        var input = this.input,
		          wasOpen = false;
		 
		        $( "<a>" )
		          .attr( "tabIndex", -1 )
		          .attr( "title", "Show All Items" )
		          .tooltip()
		          .appendTo( this.wrapper )
		          .button({
		            icons: {
		              primary: "ui-icon-triangle-1-s"
		            },
		            text: false
		          })
		          .removeClass( "ui-corner-all" )
		          .addClass( "custom-combobox-toggle ui-corner-right" )
		          .mousedown(function() {
		            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
		          })
		          .click(function() {
		            input.focus();
		 
		            // Close if already visible
		            if ( wasOpen ) {
		              return;
		            }
		 
		            // Pass empty string as value to search for, displaying all results
		            input.autocomplete( "search", "" );
		          });
		      },
		 
		      _source:  function( request, response ) {        
		          var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );

		          response(                
		            this.element.children( "option" ).map(function() {
		          
		              var text = $( this ).text();
		              if ( this.value && ( !request.term || matcher.test(text) ) )
		                return {
		                  label: text,
		                  value: text,
		                  option: this
		                };
		          })
		        );
		    
		          
		      },
		 
		      _removeIfInvalid: function (event, ui) {
		    	  var dest =  [];	
		    	  autocompeteDes(dest);
		          var index = $("select#desNom_Select :selected").val();
		          
		          if (index != '0')
		          {		        	  
			          $("input#destinateur-nom").val(dest[parseInt(index, 10)][0]);
			          $("input#dest-telephone").val(dest[parseInt(index, 10)][1]);
			          $("input#dest-code-postale").val(dest[parseInt(index, 10)][2]);
			          $("textarea#dest-adresse").val(dest[parseInt(index, 10)][3]);
			          $("input#dest-ville").val(dest[parseInt(index, 10)][4]);
		      	  }else{
			          $("input#destinateur-nom").val($("input#combobox-dest-nom").val());
		      	  }
		      },
		 
		      _destroy: function() {
		        this.wrapper.remove();
		        this.element.show();
		      }
		    });
		  })( jQuery );
		
		
		 (function comboboxSender( $ ) {
			    $.widget( "custom.comboboxExp", {
			      _create: function() {
			        this.wrapper = $( "<span>" )
			          .addClass( "exp_com_combobox" )
			          .insertAfter( this.element );
			 
			        this.element.hide();
			        this._createAutocomplete();
			        this._createShowAllButton();
			      },
			 
			      
			      _createAutocomplete: function() {
			        var selected = this.element.children( ":selected" ),
			          value = selected.val() ? selected.text() : "";			 
			        this.input = $( "<input>" )
			          .appendTo( this.wrapper )
			          .val( value )
			          .attr( "title", "" )
			          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
			          .attr("id", "combobox-exp-nom")
			          .autocomplete({
			            delay: 0,
			            minLength: 0,
			            source: $.proxy( this, "_source" )
			          })
			          .tooltip({
//			            tooltipClass: "ui-state-highlight"
			          });
			    	  
			    	  
			        this._on( this.input, {
			          autocompleteselect: function( event, ui ) {
			            ui.item.option.selected = true;
			            this._trigger( "select", event, {
			              item: ui.item.option
			            });
			          },
			 
			          autocompletechange: "_removeIfInvalid",
			        });
			      },		        
			      _createShowAllButton: function() {
			        var input = this.input,
			          wasOpen = false;
		            
		            
			        $( "<a>" )
			          .attr( "tabIndex", -1 )
			          .attr( "title", "Show All Items" )
			          .tooltip()
			          .appendTo( this.wrapper )
			          .button({
			            icons: {
			              primary: "ui-icon-triangle-1-s"
			            },
			            text: false
			          })
			          .removeClass( "ui-corner-all" )
			          .addClass( "custom-combobox-toggle ui-corner-right" )
			          .mousedown(function() {
			            wasOpen = input.autocomplete( "widget" ).is( ":visible" );			            
			            
			          })
			          .click(function() {			        	  
			            input.focus();
			            // Close if already visible
			            if ( wasOpen ) {
			              return;
			            }
			 
			            // Pass empty string as value to search for, displaying all results
			            input.autocomplete( "search", "" );
			          });
			      },
			      _source:  function( request, response ) {        
			          var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
			          response(                
			            this.element.children( "option" ).map(function() {
			              var text = $( this ).text();
			              if ( this.value && ( !request.term || matcher.test(text) ) )
			                return {
			                  label: text,
			                  value: text,
			                  option: this
			                };
			          })
			        );
			    
			          
			      },
			      _removeIfInvalid: function (event, ui) {
			          var exp = [];
			          autocompeteExp(exp);
			          var indexExp = $("select#expNom_Select :selected").val();
			          
			          if (indexExp != '0')
			          {
				          $("input#expediteur-nom").val(exp[parseInt(indexExp, 10)][0]);
				          $("input#exp-telephone").val(exp[parseInt(indexExp, 10)][1]);
				          $("input#exp-code-postale").val(exp[parseInt(indexExp, 10)][2]);
				          $("textarea#exp-adresse").val(exp[parseInt(indexExp, 10)][3]);
				          $("input#exp-ville").val(exp[parseInt(indexExp, 10)][4]);
			      	  }else{
				          $("input#expediteur-nom").val($("input#combobox-exp-nom").val());
			      	  }   
			      },
			 
			      _destroy: function() {
			        this.wrapper.remove();
			        this.element.show();
			      }
			    });
			  })( jQuery );
		
		$("input#check_password").change(function(){
			checkPwd = $(this).val();
			pwd = $("input#password").val();
			if (pwd != checkPwd){
				alert("确认密码错误\n请输入相同密码");
			}
		});
		
		
		
		
		
		 $(function AddNewArticle() {
			 
			 
			 var dialogArticle, form,
			 
			      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
			      //emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
			      
			      descript = $( "#description" ),
			      quantity = $( "#quantity" ),
			      poids = $( "#poids" ),
			      valeur = $( "#valeur" ),
			      
			      allFields = $( [] ).add( descript ).add( quantity ).add( poids ).add( valeur ),
			      tips = $( ".validateTips" );
			    

			 
			    function updateTips( t ) {
			      tips
			        .text( t )
			        .addClass( "ui-state-highlight" );
			      setTimeout(function() {
			        tips.removeClass( "ui-state-highlight", 1500 );
			      }, 500 );
			    }
			 
			    function checkLength( o, n, min, max ) {
			      if ( o.val().length > max || o.val().length < min ) {
			        o.addClass( "ui-state-error" );
			        updateTips( "Length of " + n + " must be between " +
			          min + " and " + max + "." );
			        return false;
			      } else {
			        return true;
			      }
			    }
			 
			    function checkRegexp( o, regexp, n ) {
			      if ( !( regexp.test( o.val() ) ) ) {
			        o.addClass( "ui-state-error" );
			        updateTips( n );
			        return false;
			      } else {
			        return true;
			      }
			    }
			 
			    var indexArticle = 1;
			    
				 function moisArticle(){
					 indexArticle--;
				 }			    
			    
			    function addUser() {
			      var valid = true;
			      allFields.removeClass( "ui-state-error" );
			      
/*			      valid = valid && checkLength( description, "description", 3, 64 );
			      valid = valid && checkLength( quantity, "quantity", 1, 2 );
			      valid = valid && checkLength( poids, "poids", 1, 2 );
			      valid = valid && checkLength( valeur, "valeur", 1, 5 );*/
			 
/*			      valid = valid && checkRegexp( description, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
			      valid = valid && checkRegexp( quantity, /^[0-9]+$/, "数量取值必须是数字" );
			      valid = valid && checkRegexp( poids, /^[0-9]+$/, "重量取值范围是 : 0-30" );
			      valid = valid && checkRegexp( valeur, /^[0-9]+$/, "价值取值必须是数字" );*/
			      
			      if ( valid && compteurArticle <=10) {
			    	  
			    	  quantityVal = parseInt(quantity.val());
			    	  poidsVal = parseFloat(poids.val()).toFixed(2);
			    	  valeurVal = parseFloat(valeur.val()).toFixed(2);
			    	  
			    	  // 添加一行新货品内容
			        $( "#articles tbody" ).append( "<tr>" +
					  "<td></td>" +
			          "<td>" + descript.val() + "</td>" +
			          "<td>" + quantityVal + "</td>" +
			          "<td>" + poidsVal + "</td>" +
			          "<td>" + valeurVal + "</td>"+
			          "<td>" + "<a href='#'>删除</a>"  + "</td>"+
			          "</tr>" );
			        
			        // 需要修改
			        //addArticles(compteurArticle, descript.val(), quantityVal, poidsVal, valeurVal);
			        
			        // 计算合计数
			        calculTotal();
			        rangerOrdre();
			        dialogArticle.dialog( "close" );
			      }else{
			    	  alert("最多可以10个详细产品!");
			      } 
			      return valid;
			    }
			 
			    dialogArticle = $( "#dialog-form" ).dialog({
			      autoOpen: false,
			      height: 400,
			      width: 350,
			      modal: true,
			      buttons: {
			        "添加": addUser,
			        "取消": function() {
			        	dialogArticle.dialog( "close" );
			        }
			      },
			      close: function() {
			        form[ 0 ].reset();
			        allFields.removeClass( "ui-state-error" );
			      }
			    });
			 
			    form = dialogArticle.find( "form" ).on( "submit", function( event ) {
			      event.preventDefault();
			      addUser();
			    });

				
			    
			    $( "#addArticle" ).on( "click", function() {
			    	dialogArticle.dialog( "open" );
			    });
			    

			    
			  });		
	    
		 
		 // begin steps
/*		 var form = $("#example-form");
		 
		 form.validate({
		     errorPlacement: function errorPlacement(error, element) {
		    	 element.before(error); 
		    	 },
		     rules: {
		         confirm: {
		             equalTo: "#password"
		         }
		     }
		 });
		 
		 form.children("div").steps({
		     headerTag: "h3",
		     bodyTag: "section",
		     transitionEffect: "slideLeft",
		     onStepChanging: function (event, currentIndex, newIndex)
		     {
		    	 
		         form.validate().settings.ignore = ":disabled,:hidden";
		         return form.valid();
		     },
		     onFinishing: function (event, currentIndex)
		     {
		         form.validate().settings.ignore = ":disabled";
		         return form.valid();
		     },
		     onFinished: function (event, currentIndex)
		     {
		         alert("Submitted!");
		     },
		     stepsOrientation: "vertical"
		 });
*/
		 // end steps

		 
		 // steps  
		 
		 
		 var colisForm = $("#colis_add_form");
		 var settings = {
				    labels: {
				        finish: "提交",
				        next: "下一步",
				        previous: "上一步",
				        loading: "加载中 ..."
				    },
				     headerTag: "h3",
				     bodyTag: "section",
				     transitionEffect: "slideLeft",
		/*		     
		 * onStepChanging: function (event, currentIndex, newIndex)
				     {
				         form.validate().settings.ignore = ":disabled,:hidden";
				         return form.valid();
				     },
				     onFinishing: function (event, currentIndex)
				     {
				         form.validate().settings.ignore = ":disabled";
				         return form.valid();
				     },
		*/		     
				     onFinished: function (event, currentIndex)
				     {
				         $("input#submit").click(); 
				     },
				     stepsOrientation: "vertical",
				    
				};
		 colisForm.children("div").steps(settings);
		 

		 
		 // end steps
		
		$("#expNom_Select").comboboxExp();	            
		$("#desNom_Select").comboboxDest();
		
		 
		$("#colis-poinds-prevu").change(myFacets.calculePoinds);
		$("#colis-assurance").change(myFacets.calculePoinds);
	
//	calculePoinds();
});


var compteurArticle = 0;

/*
$("#addArticle").on("click", function(even){
	if (compteurArticle <= 10){
		  $( "table#articles tbody" ).append( "<tr><td></td>" +
		          "<td>des</td>" +
		          "<td>2</td>" +
		          "<td>1.5</td>" +
		          "<td>2.03</td>"+
				  "<td><a href='#'>delete</a></td>"+
		          "</tr>" );
		calTotal();	
		rangerOrdre();	
	}else{
		alert("déjà 10 articles");
	}
});
*/


function calculTotal(){
	
	var tableArticle = document.getElementById("articles");			
	
	var index = 1;
	var qT = 0, pT = 0, vT = 0;
	while (tableArticle.rows[index].cells[0].innerHTML != "总计" ) { 
		// Récuperer les données de la ligne
		var q = tableArticle.rows[index].cells[2].innerHTML;
		var p = tableArticle.rows[index].cells[3].innerHTML;
		var v = tableArticle.rows[index].cells[4].innerHTML;

		//alert("qT: "  + q +  ", pT:  " + p +  + ", VT = " + v);			
		
		qT = qT + parseInt(q);
		pT = pT + (parseFloat(q) * parseFloat(p));
		vT = vT + (parseFloat(q) * parseFloat(v));
		index++;
	} 
	

	tableArticle.rows[index].cells[2].innerHTML = parseInt(qT);
	tableArticle.rows[index].cells[3].innerHTML = parseFloat(pT).toFixed(2);
	tableArticle.rows[index].cells[4].innerHTML = parseFloat(vT).toFixed(2);	
	
}

function rangerOrdre(){
	var tableArticle = document.getElementById("articles");	
	var index = 1;
	
	while (tableArticle.rows[index].cells[0].innerHTML != "总计" ) { 
		// 
		tableArticle.rows[index].cells[0].innerHTML = index;
		tableArticle.rows[index].cells[5].innerHTML = "<a href='#' onclick='delRow(" + index + ");'>删除</a>";
				
		addArticles(index, tableArticle.rows[index].cells[1].innerHTML, tableArticle.rows[index].cells[2].innerHTML,
				tableArticle.rows[index].cells[3].innerHTML, tableArticle.rows[index].cells[4].innerHTML);
		
		
		index++;
	}	 
	
	compteurArticle = index;
}

// 记录下来货品详细内容
function addArticles (index, descript, quantity, poids, valeur) {
    $("input#descript" + index).val(descript);
    $("input#quantity" + index).val(quantity);
    $("input#poids" + index).val(poids);
    $("input#valeur" + index).val(valeur);
}



function delRow(index){
	
	var tableArticle = document.getElementById("articles");
	//alert(tableArticle.rows[index].innerHTML);
	tableArticle.deleteRow(index);
	calculTotal();
	rangerOrdre();
}	


//$("select, #colis-poinds-prevu").change(calculePoinds);
//calculePoinds();
