const users = document.getElementById('users');

if(users){
    users.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Estas seguro?')){
                const id = e.target.getAttribute('data-id');
            
                fetch(`/user/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
           }
        }
    });
}

const medics = document.getElementById('medics');

if(medics){
    medics.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Estas seguro?')){
                const id = e.target.getAttribute('data-id');
            
                fetch(`/medic/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
           }
        }
    });
}

const medic_group = document.getElementById('medic_group');

if(medic_group){
    medic_group.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Estas seguro?')){
                const id = e.target.getAttribute('data-id');
            
                fetch(`/group/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
           }
        }
    });
}

const employees = document.getElementById('employees');

if(employees){
    employees.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Estas seguro?')){
                const id = e.target.getAttribute('data-id');
            
                fetch(`/employee/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
           }
        }
    });
}

const schedules = document.getElementById('schedules');

if(schedules){
    schedules.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Estas seguro?')){
                const id = e.target.getAttribute('data-id');
            
                fetch(`/schedule/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
           }
        }
    });
}

const categories = document.getElementById('categories');

if(categories){
    categories.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Estas seguro?')){
                const id = e.target.getAttribute('data-id');
            
                fetch(`/medic/category/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
           }
        }
    });
}

const patients = document.getElementById('patients');

if(patients){
    patients.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Estas seguro?')){
                const id = e.target.getAttribute('data-id');
            
                fetch(`/patient/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
           }
        }
    });
}

const appointments = document.getElementById('appointments');

if(appointments){
    appointments.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Estas seguro?')){
                const id = e.target.getAttribute('data-id');
            
                fetch(`/appointment/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
           }
        }
    });
}


