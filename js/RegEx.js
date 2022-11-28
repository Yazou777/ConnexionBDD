const inputs = document.querySelectorAll('input');

const patterns = {
  titre: /.{1}/,
  year: /^[0-9]{4}$/,
  price: /^\d+(?:[.]\d+)?$/i,
  phone: /^\d{3}-\d{3}-\d{4}$/
};

inputs.forEach((input) => {
  input.addEventListener('keyup', (e) => {
    validate(e.target, patterns[e.target.attributes.id.value]);
  });
});

function validate(field, regex) {
  if (regex.test(field.value)) {
    field.className = 'form-control valid';
  } else {
    field.className = 'form-control invalid';
    
  }
}







function checkForm(f) {
    var x  = document.querySelector('#titre').value;
    var filtre = new RegExp("^.{1}");
    var resultat = filtre.test(x);
    console.log(resultat);
    if (resultat==false) {
       
        return false;
    }

    var x  = document.querySelector('#year').value;
    var filtre = new RegExp("^[0-9]{4}$");
    var resultat = filtre.test(x);
    console.log(resultat);
    if (resultat==false) {
        
        return false;
    }

    var x  = document.querySelector('#price').value;
    var filtre = new RegExp("^[0-9\.]+$");
    var resultat = filtre.test(x);
    console.log(resultat);
    if (resultat==false) {
        
        return false;
    }
    
    var x  = document.querySelector('#ville').value;
    var filtre = new RegExp("^[A-Za-z]+$");
    var resultat = filtre.test(x);
    console.log(resultat);
    if (resultat==false) {
        alert("Entrez seulement des caracteres dans la case Ville");
        return false;
    }
}
