 $(document).ready(function () { 


$(".aaaa").click(function(){
    var tid= $(this).attr("bid");
    console.log(tid);
    $.ajax({
        type:"POST",
        url: "/include/addtocart.php",
        data: "id="+tid,
        dataType: "html",
        cache: false,
        success: function(data){
            loadcart();
        }    
        
    });   
});

function loadcart(){
    $.ajax({
        type:"POST",
        url: "/include/loadcart.php",
        dataType: "html",
        cache: false,
        success: function(data){
            if(data == "0"){
                $("#basket > a").html("Корзина");
            }else{
                
                 $("#basket > a").html(data);
               
                
            }
        }
           
    });  
}

$(".count-minus").click(function(){
    
    var iid=$(this).attr("iid");
    console.log('yes');
    $.ajax({
        type:"POST",
        url:"/include/count-minus.php",
        data:"id="+iid,
        dataType: "html",
        cache: false,
        success: function(data){
            $("#input-id"+iid).val(data);
            loadcart();
            
            var priceproduct = $("#tovar"+iid+" > p").attr("price");
            
            var  result_total = Number(priceproduct) * Number(data);
            
            
            $("#tovar"+iid+" > p").html(result_total + " руб");
            $("#tovar"+iid+" > h5 > .span-count").html(data);
            
            itog_price();
            
            
        }  
    });  
    
});  
     
     
$(".count-plus").click(function(){
    
    var iid = $(this).attr("iid");
    console.log('yes');
    $.ajax({
        type:"POST",
        url:"/include/count-plus.php",
        data:"id="+iid,
        dataType: "html",
        cache: false,
        success: function(data){
            $("#input-id"+iid).val(data);
            loadcart();
            
            var priceproduct = $("#tovar"+iid+" > p").attr("price");
            
            var  result_total = Number(priceproduct) * Number(data);
            
            
            $("#tovar"+iid+" > p").html(result_total + " руб");
            $("#tovar"+iid+" > h5 > .span-count").html(data);
            
            itog_price();
            
            
        }  
    });  
    
});       
     

     
     
$(".count-input").keypress(function(e){
    if(e.keyCode==13){
        
    var iid = $(this).attr("iid");
    var incount = $("#input-id"+iid).val();
     console.log(incount);  
        
    $.ajax({
        type:"POST",
        url:"/include/count-input.php",
        data:"id="+iid+"&count="+incount,
        dataType: "html",
        cache: false,
        success: function(data){
            $("#input-id"+iid).val(data);
            loadcart();
            
              var priceproduct = $("#tovar"+iid+" > p").attr("price");
            
            var  result_total = Number(priceproduct) * Number(data);
            
            
            $("#tovar"+iid+" > p").html(result_total + " руб");
            $("#tovar"+iid+" > h5 > .span-count").html(data);
            
            itog_price();
            
            
        }  
    });  
   }
});  
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
 
     
function itog_price(){
    
    $.ajax({
       type:"POST",
       url:"/include/itog_price.php",
        dataType:"html",
        cache: false,
        success: function(data){
            $(".itog-price > strong").html(data);
        }
        
    });    
}     
     
     
     
});


















