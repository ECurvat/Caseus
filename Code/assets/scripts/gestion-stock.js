const btnAjouterProduit = document.querySelector('[name="entreeAjouterProduit"]');
const btnEntreeValider = document.querySelector('[name="entreeValider"]');

btnAjouterProduit.addEventListener('click',function(ev) {
    let spanNbProduits = document.getElementById('nbProduits');
    spanNbProduits.textContent = parseInt(spanNbProduits.textContent) + 1;
    // récupérer l'alarme exemple
    const exempleAjout = document.getElementById("exempleAjout");
    var nouvelAjout = exempleAjout.cloneNode(true);
    nouvelAjout.removeAttribute("id"); // pour qu'on la voit
    
    // insertion dans le DOM
    const formulaire = document.getElementById("entreeLivraison");
    formulaire.insertBefore(nouvelAjout,btnEntreeValider); 

    nouvelAjout.addEventListener("click", function(e) {
        if(e.target.tagName === "BUTTON"){
            e.currentTarget.remove();
            spanNbProduits.textContent = parseInt(spanNbProduits.textContent) - 1;
        };
    });

});