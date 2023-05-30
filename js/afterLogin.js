$(document).ready(function(){
// 
//   sign in & out
let order = {};
order["get_data"] = "start";
let user_data = {};
function signIn(user_data){
    $('#loginBtn').text('歡迎，' + user_data['username']);
    $('#loginBtn').attr('href', 'javascript:;');
    let $login_data = $('#login_data_template').clone();
    $login_data.attr('id', 'login_data');
    $login_data.find('img').attr('src', user_data['userhead']);
    $login_data.find('img').attr('alt', user_data['username']);
    $login_data.find('p').text(user_data['username']);
    $('#loginBtn').parent('nav').append($login_data);
};  
$.ajax({
    type: "POST",
    url: "user_data.php",
    data: order,
    datatype: "json"
}).done(function(data){
    user_data = data;
    signIn(user_data);
}).fail(function(){
    location.href = "error_page.php";
});

// even listen
$('#loginBtn').click(function(event){
    $('#login_data').toggleClass('display_none');
    event.stopPropagation();
});
$(document).on('click', '#login_data', function(event){
    $('#login_data').removeClass('display_none');
    event.stopPropagation();
})
$('body').click(function(){
    $('#login_data').addClass('display_none');
})
$(document).on('click', '.signOut', function(){
    order['event'] = "signOut";
    $.ajax({
        type: "POST",
        url: "check.php",
        data: order
    }).done(function(){
        location.href = location.href;
    })
})


// NEW CARD

$(document).on('click', '.card', function(){
    $('.popup_content').empty();
    let the_animal = $('select').val();
    let the_card = $(this).find('img').attr('alt');
    if(typeof user_data['cards'][the_animal] !== 'undefined' && typeof user_data['cards'][the_animal][the_card] !== 'undefined'){
        let animal_card_data = user_data['cards'][the_animal][the_card];
        let $newCard = $('#newCard_template').clone();
        $newCard.attr('id', 'newCard');
        $newCard.empty();
        for(let i=0; i<animal_card_data.length; i++){
            let $newCard_data = $('#newCard_template img').clone();
            $newCard_data.attr('src', animal_card_data[i]['src']);
            $newCard_data.attr('alt', animal_card_data[i]['alt']);
            $newCard.append($newCard_data);
        };
        $('.popup_content').append($newCard);
        $('#newCard').slick({
            arrows: false,
            autoplay: true,
            autoplaySpeed: 3000,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnFocus: false,
            pauseOnHover: false
        });      
    } else {
        let $buyCard = $('.buy_card').clone();
        $buyCard.removeClass('display_none');
        $('.popup_content').append($buyCard);
        $('a.later').click(function(){
            $('#popup_background').addClass("display_none");
        })    
    }
    $('#newCard').removeClass('display_none');
    $('#popup_background').removeClass("display_none");
});


// 
})