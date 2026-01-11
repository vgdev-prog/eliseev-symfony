import React from 'react';

import React from 'react';

const App = ({type,title,...props}) => {
    return (
        <div>

        </div>
    );
};


const Button = ({type,title,...props}) => {
    return (
        <div {...event} onClick={()}>

        </div>
    );
};

export default App;


fetch('http://localhost/api/posts').then(res => res.json()).then(res => {
    console.log(res.data)
})

const user = {
    id: 1,
    name: 'USer'
}
fetch('http://localhost/api/post',{
    method:"POST",
    body: JSON.stringify(user)
}).then(response => response.json()).then(result => {
    console.log(result.data)
})

axios.get('http://localhost/post')

