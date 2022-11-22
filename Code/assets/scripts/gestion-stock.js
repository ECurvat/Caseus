if (document.querySelector('[name="entreeAjouterLigne"]') !== null) {
    const btnEntreeAjouterLigne = document.querySelector('[name="entreeAjouterLigne"]');
    const btnEntreeValider = document.querySelector('[name="entreeValider"]'); // btn validation formulaire
    var listeFieldSetsEntree = [];
    btnEntreeAjouterLigne.addEventListener('click',function(ev) {
        
    let spanEntreeNbLigne = document.getElementById('nbLignesEntree');
        spanEntreeNbLigne.textContent = parseInt(spanEntreeNbLigne.textContent) + 1;
        // récupérer le formulaire exemple
        const exempleLigneEntree = document.getElementById("exempleLigneEntree");
        var nouvelleLigneEntree = exempleLigneEntree.cloneNode(true);
        refreshAttributesEntree(nouvelleLigneEntree, listeFieldSetsEntree.length);
        
        listeFieldSetsEntree.push(nouvelleLigneEntree);
        // insertion dans le DOM
        const formulaireEntree = document.getElementById("entree");
        formulaireEntree.insertBefore(nouvelleLigneEntree,btnEntreeValider); 

        nouvelleLigneEntree.addEventListener("click", function(e) {
            if(e.target.tagName === "BUTTON"){
                e.currentTarget.remove();
                spanEntreeNbLigne.textContent = parseInt(spanEntreeNbLigne.textContent) - 1;
                let index = listeFieldSetsEntree.indexOf(nouvelleLigneEntree);
                listeFieldSetsEntree.splice(index, 1);
                // actualisation des paramètres des fieldsets suivants
                if(listeFieldSetsEntree.length > 0 && listeFieldSetsEntree.length != index) {
                    for (let i = index; i < listeFieldSetsEntree.length; i++) {
                        const element = listeFieldSetsEntree[i];
                        refreshAttributesEntree(listeFieldSetsEntree[i], i);
                    }
                }
            };
        });    

});

function refreshAttributesEntree(fieldset, nombre) {
    fieldset.setAttribute("id", nombre); // pour qu'on le voit + récupère plus tard
    fieldset.querySelector('label[id="entreeNomProduit"]').setAttribute("for",  "entreeNomProduit" + nombre);
    fieldset.querySelector('select[id="entreeNomProduit"]').setAttribute("name",  "entreeNomProduit" + nombre);
    fieldset.querySelector('label[id="entreeQteProduit"]').setAttribute("for",  "entreeQteProduit" + nombre);
    fieldset.querySelector('input[id="entreeQteProduit"]').setAttribute("name",  "entreeQteProduit" + nombre);
    fieldset.querySelector('input[id="entreeQteProduit"]').setAttribute("required", "");
    fieldset.querySelector('button').setAttribute("id",  "entreeRetirerProduit" + nombre);
}
} else if (document.querySelector('[name="sortieAjouterLigne"]') !== null) {
    const btnSortieAjouterLigne = document.querySelector('[name="sortieAjouterLigne"]');
    const btnSortieValider = document.querySelector('[name="sortieValider"]'); // btn validation formulaire
    var listeFieldSetsSortie = [];
    btnSortieAjouterLigne.addEventListener('click',function(ev) {
        console.log('click');
        let spanSortieNbLigne = document.getElementById('nbLignesSortie');
            spanSortieNbLigne.textContent = parseInt(spanSortieNbLigne.textContent) + 1;
            // récupérer le formulaire exemple
            const exempleLigneSortie = document.getElementById("exempleLigneSortie");
            var nouvelleLigneSortie = exempleLigneSortie.cloneNode(true);
            refreshAttributesSortie(nouvelleLigneSortie, listeFieldSetsSortie.length);
            
            listeFieldSetsSortie.push(nouvelleLigneSortie);
            // insertion dans le DOM
            const formulaireSortie = document.getElementById("sortie");
            formulaireSortie.insertBefore(nouvelleLigneSortie,btnSortieValider); 

            nouvelleLigneSortie.addEventListener("click", function(e) {
                if(e.target.tagName === "BUTTON"){
                    e.currentTarget.remove();
                    spanSortieNbLigne.textContent = parseInt(spanSortieNbLigne.textContent) - 1;
                    let index = listeFieldSetsSortie.indexOf(nouvelleLigneSortie);
                    listeFieldSetsSortie.splice(index, 1);
                    // actualisation des paramètres des fieldsets suivants
                    if(listeFieldSetsSortie.length > 0 && listeFieldSetsSortie.length != index) {
                        for (let i = index; i < listeFieldSetsSortie.length; i++) {
                            const element = listeFieldSetsSortie[i];
                            refreshAttributesSortie(listeFieldSetsSortie[i], i);
                        }
                    }
                };
            });    

    });

    function refreshAttributesSortie(fieldset, nombre) {
        fieldset.setAttribute("id", nombre); // pour qu'on le voit + récupère plus tard
        fieldset.querySelector('label[id="sortieNomProduit"]').setAttribute("for",  "sortieNomProduit" + nombre);
        fieldset.querySelector('select[id="sortieNomProduit"]').setAttribute("name",  "sortieNomProduit" + nombre);
        fieldset.querySelector('label[id="sortieQteProduit"]').setAttribute("for",  "sortieQteProduit" + nombre);
        fieldset.querySelector('input[id="sortieQteProduit"]').setAttribute("name",  "sortieQteProduit" + nombre);
        fieldset.querySelector('input[id="sortieQteProduit"]').setAttribute("required", "");
        fieldset.querySelector('button').setAttribute("id",  "sortieRetirerProduit" + nombre);
    }
}


