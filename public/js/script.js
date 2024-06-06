//окно подтверждения действия
function openPopup(x) {
    document.querySelector('.popup'+x).style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
    document.querySelector('.menu-window').style.display='none';
}
function closePopup(x) {
    document.querySelector('.popup'+x).style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}
//перелистывание страниц
var prevBtn = document.querySelector(".previous");
var nextBtn = document.querySelector(".next");
var sendBtn = document.querySelector(".send");

function previous(currentPage, maxPage) {
    document.querySelector('.page-' + currentPage).style.display = 'none';
    document.querySelector('.page-' + (currentPage - 1)).style.display = 'block';

    if (currentPage - 1 > 1) {
        prevBtn.style.display = 'block';
        nextBtn.style.display = 'block';
        sendBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'block';
        sendBtn.style.display = 'none';
    }

    prevBtn.onclick = function() {
        previous(currentPage - 1, maxPage);
    };
    nextBtn.onclick = function() {
        next(currentPage - 1, maxPage);
    };
}

function next(currentPage, maxPage) {
    console.log(1);
    let inputs = document.getElementsByClassName('required-'+currentPage);
    let isValid = true;
    for (var i = 0; i < inputs.length; i++) {
        if (!inputs[i].checkValidity()) {
            isValid = false;
            inputs[i].reportValidity();
        }
    }
    if(isValid){
        document.querySelector('.page-' + currentPage).style.display = 'none';
        document.querySelector('.page-' + (currentPage + 1)).style.display = 'block';

        prevBtn.onclick = function() {
            previous(currentPage + 1, maxPage);
        };
        nextBtn.onclick = function() {
            next(currentPage + 1, maxPage);
        };

        if (currentPage + 1 < maxPage) {
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'block';
            sendBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'none';
            sendBtn.style.display = 'block';
        }
    }

}
//Копирование ссылки
let message=document.querySelector('.message');
function copy(){
let value=document.querySelector('.copy-value').value;
    try{
        navigator.clipboard.writeText(value);
        message.innerHTML='Ссылка скопирована!';
        message.classList.add('message-success');
        setTimeout(()=> message.classList.remove('message-success'),2000);
    }catch(error){
        console.log('Ошибка при копировании:',error);
        message.innerHTML='Не удалось скопировать ссылку!';
        message.classList.add('message-error');
        setTimeout(()=> message.classList.remove('message-error'),2000);
    }
}
// Уведомления
function messagePopup(text,type){
    if(type=='success'){
        setTimeout(()=> {
            message.innerHTML=text;
            message.classList.add('message-success');
        },300);
        setTimeout(()=> message.classList.remove('message-success'),2000);
    }else{
        setTimeout(()=> {
            message.innerHTML=text;
            message.classList.add('message-error');
        },300);
        setTimeout(()=> message.classList.remove('message-error'),2000);
    }
}

