
function showAds(ads){

    var buffer = '';
    var adsCount = 0;
    var customerType = localStorage.getItem('customerId') == null ? 'anonymous' : 'subscriber';

    for(var i = 0; i < ads.length; i++){
        if((ads[i].target == 1 || ads[i].target == 3) && customerType == 'anonymous'){
            adsCount += 1;

            buffer += '  <a class="ad-'+adsCount+'" href="'+ads[i].link+'" target="_blank" style="display: none;">';
            buffer += '<div style=" background-image: url('+ads[i].images.preview+');width: 100%;height: 100%; background-repeat: no-repeat; background-size: 100% 101%;">';
            buffer += '</div>';
            buffer += '  </a>';

        }
        else if((ads[i].target == 2 || ads[i].target == 3) && customerType == 'subscriber'){
            adsCount += 1;

            buffer += '  <a class="ad-'+adsCount+'" href="'+ads[i].link+'" target="_blank" style="display: none;">';
            buffer += '<div style=" background-image: url('+ads[i].images.preview+');width: 100%;height: 100%; background-repeat: no-repeat; background-size: 100% 101%;">';
            buffer += '</div>';
            buffer += '  </a>';
        }
    }

    if(buffer !== ''){
        $('#ads').find('div.modal-content').append(buffer);
        $('#ads').modal('show');
        fadeAds(adsCount);
    }

}

function fadeAds(counter) {

    if(counter == 0){
        var header   = "<!-- header -->";
        header      +=  '<div class="modal-header">';
        header      +=      '<span data-dismiss="modal">';
        header      +=          '<i class="fa fa-times-circle" style="font-size: 30px;"></i>';
        header      +=      '</span>';
        header      +=  '</div>';
        header      += '<!-- header -->';

        $('#ads').modal('hide');
        $('#ads').find('div.modal-content').html(header);
        return;
    }

    $('.ad-'+counter).fadeIn(3000, function(){
        setTimeout(function () {
            $('.ad-'+counter).fadeOut(3000, function () {
                counter--;
                fadeAds(counter);
            })
        }, 6000)
    });

}
