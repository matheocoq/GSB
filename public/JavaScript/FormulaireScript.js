$('#confirmer').click(function(){
    
    if($('#inputUsername').val()==""){
        $('#spanIdentifiant').show().text('login obligatoire');
        $('#spanIdentifiant').addClass('alert alert-danger');
        
    }

    if($('#inputUsername').val()!="")
    {
        $('#spanIdentifiant').hide().text(''); 
        
    }

    if($('#inputPassword').val()==""){
        $('#spanMDP').show().text('mots de passe obligatoire');
        $('#spanMDP').addClass('alert alert-danger');
        
    }

    if($('#inputPassword').val()!="")
    {
        $('#spanMDP').hide().text(''); 
        
    }
    
    
    
})


$('.form-control').blur(function(){
    
    if($('#qte1').val()<0 ){
        $('#spanQTE1').show().text('La valeur ne peut être négative');
        $('#spanQTE1').addClass('alert alert-danger');
        
    }
    
    

    if($('#qte2').val()<0){
        $('#spanQTE2').show().text('La valeur ne peut être négative');
        $('#spanQTE2').addClass('alert alert-danger');
        
    }
    

    if($('#qte3').val()<0){
        $('#spanQTE3').show().text('La valeur ne peut être négative');
        $('#spanQTE3').addClass('alert alert-danger');
        
    }
   

    if($('#qte4').val()<0){
        $('#spanQTE4').show().text('La valeur ne peut être négative');
        $('#spanQTE4').addClass('alert alert-danger');
        
    }
    
    
    
})

$('.form-control').blur(function(){
    
    if($('#qte1').val()>0 ){
        $('#spanQTE1').hide().text('');
        
    }
    
    

    if($('#qte2').val()>0){
        $('#spanQTE2').hide().text('');
       
        
    }
    

    if($('#qte3').val()>0){
        $('#spanQTE3').hide().text('');
        
    }
   

    if($('#qte4').val()>0){
        $('#spanQTE4').hide().text('');
        
    }
    
    
    
})
