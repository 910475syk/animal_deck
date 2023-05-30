$(document).ready(function(){
// 

    // flex寬度變化
    var card3 = true;
    var card6 = false;
    var card1 = false;
    $('#flex_buttom').click(function(){
        if(card3){
            $('#animal_list').children('.card').removeClass('threeCard');
            $('#card-template').removeClass('threeCard');
            card3 = false;
            $('#animal_list').childern('.card').addClass('sixCard');
            $('#card-template').addClass('sixCard');
            card6 = true;
            $('#flex_button').text('6')
        } else if(card6){
            $('#animal_list').children('.card').removeClass('sixCard');
            $('#card-template').removeClass('sixCard');
            card6 = false;
            $('#animal_list').children('.card').addClass('oneCard');
            $('#card-template').addClass('oneCard');
            card1 = true;
            $('#flex_button').text('1');
        } else if(card1){
            $('#animal_list').children('.card').removeClass('oneCard');
            $('#card-template').removeClass('oneCard');
            card1 = false;
            $('#animal_list').children('.card').addClass('threeCard');
            $('#card-template').addClass('threeCard');
            card3 = true;
            $('#flex_button').text('3');
        }
    })

    // 匯入動物資料
    var animal_data_input = function(animal_data){
        for(let i=0; i<animal_data.length; i++){
            var $newAnimal = $('#card-template').clone();
            $newAnimal.find('img').attr('src', animal_data[i]['src']);
            $newAnimal.find('img').attr('alt', animal_data[i]['alt']);
            $newAnimal.find('h3').text(animal_data[i]['title']);
            $newAnimal.find('p').text(animal_data[i]['content']);
            $newAnimal.attr('id', '');
            $newAnimal.css('display', 'block');
            $('#animal_list').append($newAnimal);
        }
    }
    var animal_order = {};
    $('form').submit(function(event){
        event.preventDefault();
        $(this).find("input").css("pointer-events", "none");
        // 指定動物
        var animal_select = $(this).find('select');
        animal_order[animal_select.attr('name')] = animal_select.val();
        animal_order['num'] = 0;
        $.ajax({
            type: "POST",
            url: "animal_category.php",
            data: animal_order,
            dataType: 'json'
        }).done(function(data){
            $('#animal_list').empty();
            animal_data_input(data);
        });
        $('#wantMore').parent().css('display', 'inline-block')
    });
    $('select').on('change', function(){
        $(this).nextAll('input').css('pointer-events', 'auto');
    });

    // 更多動物
    $("#wantMore").click(function(){
        // 指定動物編號
        var the_biggest = animal_order["num"];
        $('.card').each(function(){
            if(parseInt($(this).attr('no'), 10) != NaN){
                if(parseInt($(this).attr('no'), 10) > the_biggest){
                    the_biggest = parseInt($(this).attr('no'), 10);
                };
            };
        });
        the_biggest++;
        animal_order['num'] = the_biggest;
        $.ajax({
            type: 'POST',
            url: "animal_category.php",
            data: animal_order,
            dataType: "json"
        }).done(function(){
            animal_data_input(data);
        });
    });

    // 動物卡片效果
    $(document).on({
        mouseenter: function(){
            $(this).css("background-color", "#cec7c7");
            $(this).find('img').css("opacity", ".5")
        },
        mouseleave: function(){
            $(this).css("background-color", "#343232");
            $(this).find('img').css("opacity", "1");
        }
    }, ".card");

    // popup
    $(document).on('click', '.card', function(){
        $('#popup_background').removeClass("display_none");
    });
    $('#popup_background').click(function(){
        $('#popup_background').addClass("display_none");
    });
    $('.popup_content').click(function(event){
        event.stopPropagation();
    });
    $('a.later').click(function(){
        $('#popup_background').addClass('display_none');
    });

// 
})