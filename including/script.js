var btn = document.querySelector('#s_btn');
if(btn){
    btn.link = btn.getAttribute('href');
    btn.addEventListener('click', dropdown);
}

if(location.hash == '#slider' || location.hash == '#slider2' || location.hash == '#myslider' || location.hash == '#new-content'){
    location.hash = '';
}

//CHECK BUTTON
function dropdown() {
    let state = this.getAttribute('class');

    if (state == 'checked') {
        this.removeAttribute('class');
        this.setAttribute('class', 'unchecked');
        this.removeAttribute('href');
        this.setAttribute('href', '#');
    }
    else {
        this.removeAttribute('unchecked');
        this.setAttribute('class', 'checked');
        this.removeAttribute('href');
        this.setAttribute('href', this.link);
    }
}

function showError(message) {
    var wrapper = document.querySelector('.message-wrapper');
    var panel = document.createElement('div');
    panel.textContent = message;
    panel.className = 'error';
    panel.addEventListener('animationend', function(event){
        event.target.remove();
    });
    wrapper.appendChild(panel);
}

function showSuccess(message) {
    var wrapper = document.querySelector('.message-wrapper');
    var panel = document.createElement('div');
    panel.textContent = message;
    panel.className = 'success';
    panel.addEventListener('animationend', function(event){
        event.target.remove();
    });
    wrapper.appendChild(panel);
}


try
{
    /*document.querySelectorAll('#editclose')[0].addEventListener('click', closeEditor);
    document.querySelectorAll('#editclose')[1].addEventListener('click', closeEditor);
    document.querySelectorAll('#editclose')[2].addEventListener('click', closeEditor);

    document.querySelector('button[name="btn-slider2-trigger"]').onclick = () => {
        document.location.hash = '#slider2';
    }
    document.querySelector('button[name="btn-slider-trigger"]').onclick = () => {
        document.location.hash = '#slider';
    }*/
}
catch(x)
{

}

let sliderCloseButtons = document.querySelectorAll('.editclose');
if(sliderCloseButtons){
    sliderCloseButtons.forEach(item => item.onclick = ()=> item.parentElement.parentElement.classList.add('hide'));
}

function showSlider1(){
    document.querySelector('#slider').classList.remove('hide');
    document.querySelector('#slider2') ? document.querySelector('#slider2').classList.add('hide') : null;
    document.querySelector('#myslider') ? document.querySelector('#myslider').classList.add('hide') : null;
}
function showSlider2(){
    document.querySelector('#slider2').classList.remove('hide');
    document.querySelector('#slider') ? document.querySelector('#slider').classList.add('hide') : null;
    document.querySelector('#myslider') ? document.querySelector('#myslider').classList.add('hide') : null;
}
function hideSliders(){
    let sliders = document.querySelectorAll('.slider');
    if(sliders)
    sliders.forEach(item => item.classList.add('hide'));
}

function closeEditor() {
    window.location.assign('#');
}


//INPUTS TYPE HANDLINGS
try
{
    document.querySelector('input[name="uname"]').addEventListener('change',() => {
    document.querySelector('input[name="uname"]').value = document.querySelector('input[name="uname"]').value.toLowerCase().trim();})
    document.querySelector('input[name="euname"]').addEventListener('change',() => {
    document.querySelector('input[name="euname"]').value = document.querySelector('input[name="euname"]').value.toLowerCase().trim();})
}
catch
{

}

if(document.querySelector('.my-details-container')){
    document.querySelector('.my-details-container').onclick = function(){
        document.querySelector('#myslider').classList.remove('hide');
        loadMyDetails();
    }
}

loadMyDetails();
function loadMyDetails(){
    let loc = location.pathname.split('/').slice(-2)[0];
    sqlQuery('../including/my-details.php', {user: loc, uname : document.username}, ()=>{
        document.querySelector('[name=ifname]').value = response[0].fname;
        document.querySelector('[name=ilname]').value = response[0].lname;
        document.querySelector('[name=idob]').value = response[0].dob;
        document.querySelector('[name=iaddress]').value = response[0].address;
        document.querySelector('[name=iemail]').value = response[0].email;
        document.querySelector('[name=iphone]').value = response[0].phone;
        document.querySelector('[name=iuname]').value = response[0].uname;
        document.querySelector('[name=ipassword').value = response[0].pass;
    });
}

function showContext(e, ...item){
    let cont = document.createElement('div');
    cont.className = 'context';
    item.forEach(x => cont.appendChild(x));
    cont.style.top = e.clientY + this.scrollY + 'px';
    cont.style.left = e.clientX + 'px';
    e.target.parentElement.parentElement.parentElement.className == 'slider' ? cont.classList.add('dark') : null;
    e.target.parentElement.parentElement.className == 'slider' ? cont.classList.add('dark') : null;
    document.body.appendChild(cont);
}

document.addEventListener('click', contextRemove);
function contextRemove(){
  let all = document.querySelectorAll('.context');
  if(all) all.forEach(item => item.remove());
}
document.addEventListener('mousedown', (e)=>{
  if(e.button == 2){
    contextRemove();
  }
});

function loadList(url, search, columns, titles){
    let request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`search=${search}`);
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            let json = JSON.parse(request.response);
            let table = document.createElement('table');
            table.lastSearch = search;
            let thead = document.createElement('thead');
            let tbody = document.createElement('tbody');
            table.appendChild(thead);
            table.appendChild(tbody);
            let trhead = document.createElement('tr');
            for(let i=0; i < titles.length; i++){
                let th = document.createElement('th');
                th.textContent = titles[i];
                trhead.append(th);
            }
            thead.appendChild(trhead);

            if(Object.keys(json).length==0){
                var tr = document.createElement('tr');
                var td = document.createElement('td');
                td.textContent='Oops... It is empty!';
                td.colSpan=columns.length;
                tr.appendChild(td);
                tbody.appendChild(tr);
            }
            for(var row of json){
                var tr = document.createElement('tr');
                for(let i=0; i < columns.length; i++){
                    var td = document.createElement('td');
                    td.textContent = row[columns[i]];
                    tr.appendChild(td);
                }
                tr.object = row;
                tr.oncontextmenu = rowClick;
                tbody.appendChild(tr);
            }

            let wrapper = document.querySelector('.table-content');
            if(wrapper.querySelector('table'))
            {
                wrapper.removeChild(wrapper.querySelector('table'));
            }
            wrapper.appendChild(table);

        } 
    }
}

function loadCard(url, search){
    let request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`search=${search}`);
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            let json = JSON.parse(request.response);
            let existingCards = document.querySelectorAll('.schedule-card');
            existingCards ? existingCards.forEach(item => item.remove()) : null;
            document.lastSearch = search;

            for(var row of json){
                let card = document.createElement('div');
                card.className = 'schedule-card';
                let batch = document.createElement('span');
                batch.className = 'schedule-card-batch';
                batch.textContent = row.batch_id;
                let lect = document.createElement('span');
                lect.className = 'schedule-card-lect';
                lect.textContent = row.fname + ' ' + row.lname;
                let footer = document.createElement('div');
                footer.className = 'schedule-card-footer';
                let day = document.createElement('span');
                day.className = 'schedule-card-day';
                day.textContent = row.day;
                let time = document.createElement('span');
                time.className = 'schedule-card-time';
                time.textContent = row.time;

                card.object = row;
                card.addEventListener('contextmenu', rowClick);
                card.addEventListener('click', leftClick);
                card.appendChild(batch);
                card.appendChild(lect);
                card.appendChild(footer);
                footer.appendChild(day);
                footer.appendChild(time);
                document.querySelector('.schedule-container').appendChild(card);
            }

        } 
    }
}

function sqlQuery(url, values, onload){
    let request = new XMLHttpRequest();
    request.open('POST',url,true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    let sendString = '';
    for(let x = 0; x < Object.keys(values).length; x++){
        sendString += Object.keys(values)[x] + '=' + values[Object.keys(values)[x]];
        if(x != Object.keys(values).length - 1)
        {
        sendString += '&';
        }
    }
    request.send(sendString);
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
        response = JSON.parse(request.response);
        onload();
        }
    }
    this.response;
}

var allInputs = document.querySelectorAll('input[type=text],input[type=time],input[type=date],input[type=password],input[type=email],select,textarea,.yuz-select');
allInputs.forEach(item => {
    let div = document.createElement('div');
    div.className = 'label-field';
    item.parentElement.appendChild(div);
    if(item.hasAttribute("label") && item.hasAttribute('id'))
    {
        let label = document.createElement('label');
        label.textContent = item.getAttribute('label');
        label.setAttribute('for',item.getAttribute('id'));
        div.appendChild(label);
    }
    div.appendChild(item);
});

function clearFields()
{
    location.hash = '';
    
    let inputs = document.querySelectorAll('input:not([type=search])');
    let selects = document.querySelectorAll('.yuz-select');
    let dropbtn = document.querySelector('#s_btn');
    let slider = document.querySelector('.slider');

    if(inputs)
    {
        inputs.forEach(item => item.value = '');
    }
    if(selects)
    {
        selects.forEach(item => selectRefresh(item));
    }
    if(dropbtn)
    {
        dropbtn.className = 'unchecked';
    }
    if(slider.value)
    {
        slider.value = '';
    }
    if(slider.object)
    {
        slider.object = '';
    }
}