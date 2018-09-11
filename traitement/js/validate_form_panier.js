function validate(form)
{
    fail=validate_quantite(form.quantite.value)

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

function validate_quantite(field)
{
    if(field=="" || isNaN(field))
    {
        return "Entrez la quantite en chiffre\n";
    }
    else if(field<=0)
    {
        return "Entrez une quantite superieur a 0\n";
    }
    return "";
}
