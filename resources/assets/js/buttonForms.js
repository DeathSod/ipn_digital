let buttonPerson = document.querySelector("#personForm");
let buttonCompany = document.querySelector("#companyForm");
let formPerson = document.querySelector('#personLayout');
let formCompany = document.querySelector('#companyLayout');

if(!!buttonPerson || !!buttonCompany)
{
    buttonPerson.addEventListener('click', () => {
        if(!buttonPerson.classList.contains('btn-primary'))
        {
            buttonCompany.classList.toggle('btn-primary');
            buttonPerson.classList.toggle('btn-primary');
            buttonPerson.style.transition = "all .6s ease-in-out";
            formPerson.classList.toggle('d-none');
            formCompany.classList.toggle('d-none');
        }
    });

    buttonCompany.addEventListener('click', () => {
        if(!buttonCompany.classList.contains('btn-primary'))
        {
            buttonCompany.classList.toggle('btn-primary');
            buttonCompany.style.transition = "all .6s ease-in-out";
            buttonPerson.classList.toggle('btn-primary');
            formPerson.classList.toggle('d-none');
            formCompany.classList.toggle('d-none');
        }
    });
}

// Array.from(buttonForm).forEach(button => {
//     button.addEventListener('click', () => {
//         Array.from(buttonForm).forEach(btn => {
//             btn.classList.toggle('btn-primary', false);
//         });
//         button.classList.toggle('btn-primary');
//     });
// });