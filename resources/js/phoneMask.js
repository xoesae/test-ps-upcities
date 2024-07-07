function phoneMask(value) {
    let phone = value.replace(/\D/g, '');
    phone = phone.substring(0, 11);
    phone = phone.replace(/\D/g,'')
    phone = phone.replace(/(\d{2})(\d)/,"($1) $2")
    phone = phone.replace(/(\d)(\d{4})$/,"$1-$2")

    return phone;  
}

window.phoneMask = phoneMask;