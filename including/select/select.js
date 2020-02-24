document.querySelectorAll('.yuz-select').forEach(element => {
    selectRefresh(element);
    element.addEventListener('click', selectClick);
    element.selectRefresh = selectRefresh;
});

//document.body.addEventListener('click', bodyClick);
document.addEventListener('click', (e)=>{
    if(document.querySelector('.yuz-select-ul') && document.querySelector('.yuz-select-ul').owner != e.target)
    {
        document.querySelector('.yuz-select-ul').remove();
    }
});

document.addEventListener('contextmenu', (e)=>{
    if(document.querySelector('.yuz-select-ul') && document.querySelector('.yuz-select-ul').owner != e.target)
    {
        document.querySelector('.yuz-select-ul').remove();
    }
});

window.addEventListener('blur', collapseAllSelects);

function selectRefresh(element) {
    element.value = undefined;
    element.querySelector('input') ? element.querySelector('input').value = "": null;
    if (element.hasAttribute('name')) {
        let hidden = document.createElement('input');
        hidden.setAttribute('hidden', '');
        hidden.setAttribute('name', element.getAttribute('name'));
        element.removeAttribute('name');
        element.appendChild(hidden);
    }

    if (!element.querySelector('text')) {
        var text = document.createElement('text');
        element.appendChild(text);
    }
    var text = element.querySelector('text');

    if (element.hasAttribute('placeholder')) {
        text.textContent = element.getAttribute('placeholder');
    }
    else if (element.querySelector('span')) {
        let firstSpan = element.querySelector('span');
        text.textContent = firstSpan.textContent;
        if (element.querySelector('input')) {
            element.querySelector('input').value = firstSpan.hasAttribute('value') ? firstSpan.getAttribute('value') : firstSpan.textContent;
        }
    }
    else {
        text.textContent = 'Oops! No options at the moment...';
    }
}

function selectInSelect(select, value)
{
    let all = select.querySelectorAll('span');
    all.forEach(item => {
        if(item.hasAttribute('value'))
        {
            if(item.getAttribute('value')==value){
                select.value = value;
                select.querySelector('input').value = value;
                select.querySelector('text').textContent = item.textContent;
            }
        }
        else
        {
            if(item.textContent==value){
                select.value = value;
                select.querySelector('input').value = value;
                select.querySelector('text').textContent = item.textContent;
            }
        }
    });
}

function selectClick(event) {
    if (!this.hasAttribute('disabled')) {
        var ul = document.createElement('ul');
        ul.link = event.target;
        let pos = this.getBoundingClientRect();
        ul.setAttribute('class', 'yuz-select-ul')
        ul.owner = this;
        ul.style.top = this.offsetTop + 'px';
        ul.style.width = this.offsetWidth + 'px';
        ul.style.left = pos.left + 'px';
        ul.style.borderRadius = getComputedStyle(this).borderRadius;
        ul.style.font = getComputedStyle(this).font;
        document.body.appendChild(ul);
        this.parentElement.parentElement.parentElement.className == 'slider' ? ul.classList.add('dark') : null;
        this.parentElement.parentElement.parentElement.className == 'slider' ? ul.style.position = 'fixed' : null;

        var caller = event.target;
        
        let children = this.querySelectorAll('span');
        for (let x = 0; x < children.length; x++) {
            let li = document.createElement('li');
            li.textContent = children[x].textContent;
            li.setAttribute('value', children[x].hasAttribute('value') ? children[x].getAttribute('value') : children[x].textContent);
            li.setAttribute('class', 'yuz-select-li');
            li.addEventListener('click', listClick);
            //this.parentElement.parentElement.parentElement.className == 'slider' ? li.classList.add('dark') : null;
            caller.nodeName=='DIV' ? li.addEventListener('click', caller.oninput) : li.addEventListener('click', caller.parentElement.oninput);
            ul.appendChild(li);
            //children[x].setAttribute('hidden','');
        }
        if (children.length < 1) {
            let li = document.createElement('li');
            li.textContent = '....';
            li.style.textAlign = 'center';
            li.setAttribute('class', 'yuz-select-li');
            //li.style.padding = getComputedStyle(this).padding + 1;
            ul.appendChild(li);
        }
    }
}

//on yuz-select-li click
function listClick() {
    document.body.removeChild(this.parentElement);
    this.parentElement.owner.value = this.getAttribute('value');
    //console.log(this.parentElement.owner.value);
    if (this.parentElement.owner.querySelector('input')) {
        this.parentElement.owner.querySelector('input').value = this.getAttribute('value');
    }
    this.parentElement.owner.querySelector('text').textContent = this.textContent;
}

function bodyClick(event) {
    /*if (event.target.classList.contains('yuz-select') || event.target.parentElement.classList.contains('yuz-select')) {
        var ul = document.body.querySelectorAll('.yuz-select-ul');
        if (ul) {
            for (let x = 0; x < ul.length; x++) {
                if (ul[x].owner == event.target || ul[x].owner == event.target.parentElement) {
                    if (x > 0) {
                        if (ul[x - 1].owner == event.target || ul[x - 1].owner == event.target.parentElement) {
                            document.body.removeChild(ul[x - 1]);
                            document.body.removeChild(ul[x]);
                        }
                    }
                }
                else {
                    document.body.removeChild(ul[x]);
                }
            }
        }
    }
    else {
        var ul = document.body.querySelectorAll('.yuz-select-ul');
        if (ul) {
            ul.forEach(each => {
                document.body.removeChild(each);
            });
        }
    }*/
}

function collapseAllSelects(event) {
    var ul = document.body.querySelectorAll('.yuz-select-ul');
    if (ul) {
        ul.forEach(each => {
            document.body.removeChild(each);
        });
    }
}