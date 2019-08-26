import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const MySwal = withReactContent(Swal);

const Presensi = (props) => {
    const initialState = () => {
        return {
            nrp: '',
            nama: '',
            asal: '',
        };
    };

    const [events, setEvents] = useState(JSON.parse(window.__INITIAL_STATE__));
    const [inputs, setInputs] = useState(initialState);

    const handleInputChange = (event) => {
        event.persist();
        const target = event.target;

        if(target.name === 'nrp') {
            const regexcheck = new RegExp('^[0-9]*$');
            if(target.value.length <= 14 && regexcheck.test(target.value)){
                setInputs(inputs => ({...inputs, [target.name]: target.value}));
            }
        }
    };

    const handleSubmit = event => {
        event.preventDefault();

        axios.put(events.endpoint, {
            nrp: inputs.nrp,
        }).then(response => {
            console.log(response);
            MySwal.fire({
                title: 'Welcome',
                text: 'Hi ' + response.data.nama + '! Jesus bless you!',
                type: 'success',
                timer: 2500,
            });
            setInputs(initialState());
        }).catch(error => {
            console.error(error);
            MySwal.fire({
                title: 'Oops!',
                text: 'Oopsie, something wrong is happening!',
                type: 'error',
                timer: 2500,
            });
        })
    };

    return (
        <div className="container h-100">
            <div className="row justify-content-center h-100 align-items-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">{events.title}</div>

                        <div className="card-body">
                            <form onSubmit={handleSubmit}>
                                {(events.type === 'Mahasiswa') ? (
                                    <input onChange={handleInputChange} name="nrp" value={inputs.nrp}/>
                                ) : (
                                    <>
                                        <input onChange={handleInputChange} name="nama" value={inputs.nama}/>
                                        <input onChange={handleInputChange} name="asal" value={inputs.asal}/>
                                    </>
                                )}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

if (document.getElementById('app')) {
    ReactDOM.render(<Presensi/>, document.getElementById('app'));
}
