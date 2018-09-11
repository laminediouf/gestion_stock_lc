function validate(form)
{
    fail=validate_surname(form.nom.value)
    fail+=validate_ename(form.prenom.value)
    fail+=validate_adresse(form.adresse.value)
    fail+=validate_tel(form.telephone.value)
    fail+=validate_email(form.email.value)

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

function validate_surname(field)
{
    if(field=="")
    {
        return "Entrer un prenom\n";
    }
    return "";
}

function validate_ename(field)
{
    if(field=="")
    {
        return "Entrer un nom de famille\n";
    }
    return "";
}

function validate_adresse(field)
{
    if(field=="")
    {
        return "Entrer une adresse\n";
    }
    return "";
}

function validate_tel(field)
{
    if(field=="" || isNaN(field))
    {
        return "Entrez l'age en chiffre\n";
    }
    return "";
}

function validate_email(field)
{
    if(field=="")
    {
        return "Entrer une adresse de courrier electronique.\n";
    }
    else if(!((field.indexOf(".")>0) && (field.indexOf("@")>0)) || /[^a-zA-Z0-9.@_-]/.test(field))
    {
        return "L'adresse de courrier electronique n'est pas valable.\n";
    }
    return "";
}
