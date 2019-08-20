import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

const Example = (props) => {
    const [events, setEvents] = useState(JSON.parse(window.__INITIAL_STATE__));
    const [inputs, setInputs] = useState({
        nrp: '',
        nama: '',
        asal: '',

    });

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

    return (
        <div className="container h-100">
            <div className="row justify-content-center h-100 align-items-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">{events.title}</div>

                        <div className="card-body">
                            <form>
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
    ReactDOM.render(<Example/>, document.getElementById('app'));
}
