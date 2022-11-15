const btnAjouterProduit = document.querySelector('[name="entreeAjouterProduit"]');
const btnEntreeValider = document.querySelector('[name="entreeValider"]');
var listeFieldSets = [];
btnAjouterProduit.addEventListener('click',function(ev) {
    
    let spanNbProduits = document.getElementById('nbProduits');
    if(parseInt(spanNbProduits.textContent) + 1 <= 10) {
        spanNbProduits.textContent = parseInt(spanNbProduits.textContent) + 1;
        // récupérer le formulaire exemple
        const exempleAjout = document.getElementById("exempleAjout");
        var nouvelAjout = exempleAjout.cloneNode(true);
        refreshAttributes(nouvelAjout, listeFieldSets.length);
        
        listeFieldSets.push(nouvelAjout);
        // insertion dans le DOM
        const formulaire = document.getElementById("entreeLivraison");
        formulaire.insertBefore(nouvelAjout,btnEntreeValider); 

        nouvelAjout.addEventListener("click", function(e) {
            if(e.target.tagName === "BUTTON"){
                e.currentTarget.remove();
                spanNbProduits.textContent = parseInt(spanNbProduits.textContent) - 1;
                let index = listeFieldSets.indexOf(nouvelAjout);
                listeFieldSets.splice(index, 1);
                if(listeFieldSets.length > 0 && listeFieldSets.length != index) {
                    for (let i = index; i < listeFieldSets.length; i++) {
                        const element = listeFieldSets[i];
                        refreshAttributes(listeFieldSets[i], i);
                    }
                }
            };
        });
    }
    

});

function refreshAttributes(fieldset, nombre) {
    fieldset.setAttribute("id", nombre); // pour qu'on le voit + récupère plus tard
    fieldset.querySelector('label[id="entreeNomProduit"]').setAttribute("for",  "entreeNomProduit" + nombre);
    fieldset.querySelector('select[id="entreeNomProduit"]').setAttribute("name",  "entreeNomProduit" + nombre);
    fieldset.querySelector('label[id="entreeQteProduit"]').setAttribute("for",  "entreeQteProduit" + nombre);
    fieldset.querySelector('input[id="entreeQteProduit"]').setAttribute("name",  "entreeQteProduit" + nombre);
    fieldset.querySelector('input[id="entreeQteProduit"]').setAttribute("required", "");
    fieldset.querySelector('button').setAttribute("id",  "entreeRetirerProduit" + nombre);
}