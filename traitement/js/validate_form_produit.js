function validate(form)
{
    fail=validate_designation(form.designation.value)
    fail+=validate_quantite(form.quantite.value)
    fail+=validate_unite(form.typeproduit.value)
    fail+=validate_prixUnitaire(form.prixunitaire.value)

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

function validate_designation(field)
{
    if(field=="")
    {
        return "Entrer une designation\n";
    }
    return "";
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

function validate_unite(field)
{
    if(field=="")
    {
        return "Entrer un type de produit\n";
    }
    return "";
}

function validate_prixUnitaire(field)
{
    if(field=="" || isNaN(field))
    {
        return "Entrez le prix unitaire en chiffre\n";
    }
    else if(field<=0)
    {
        return "Entrez un prix superieur a 0\n";
    }
    return "";
}
