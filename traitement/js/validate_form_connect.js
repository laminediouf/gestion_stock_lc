function validate(form)
{
    fail=validate_username(form.username.value)

    if(((validate_username(form.password.value))=="" && (validate_username(form.pin.value))) ||
        ((validate_username(form.password.value)) && (validate_username(form.pin.value))==""))
    {
        fail+="";
    }
    else
    {
        fail+=validate_password(form.password.value)
        fail+=" ou "
        fail+=validate_pin(form.pin.value)
    }

    if(fail=="")
    {
        return true;
    }
    else
    {
        alert(fail);
        return false;
    }
}

function validate_username(field)
{
    if(field=="")
    {
        return "Entrez le login\n";
    }
    return "";
}

function validate_password(field)
{
    if(field=="")
    {
        return "Entrez le mot de passe\n";
    }
    return "";
}

function validate_pin(field)
{
    if(field=="" || isNaN(field))
    {
        return "le pin en chiffre\n";
    }
    return "";
}
