const inputs = document.querySelectorAll('input');

const patterns = {
  
  mdp: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[*@!#%&()^~{}]).{12}/,
  email: /^[a-zA-Z0-9_-]+@([a-zA-Z0-9-]+\.)+[a-zA-Z0-9_-]{2,4}$/,
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
    if (document.querySelector('#mdp').value != document.querySelector('#confirmmdp').value)
    {
        document.querySelector('#confirmmdp').className = 'form-control invalid';
        return false;
      
    }

    var x  = document.querySelector('#mdp').value;
    var filtre = new RegExp("(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*@!#%&()^~{}]).{12}");
    var resultat = filtre.test(x);
    console.log(resultat);
    if (resultat==false) {
       
        return false;
        
    }

    var x  = document.querySelector('#email').value;
    var filtre = new RegExp("^[a-zA-Z0-9_-]+@([a-zA-Z0-9-]+\.)+[a-zA-Z0-9_-]{2,4}$");
    var resultat = filtre.test(x);
    console.log(resultat);
    if (resultat==false) {
       
        return false;
        
    }
}
