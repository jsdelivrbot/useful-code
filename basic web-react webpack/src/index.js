import React from 'react';
import { render } from 'react-dom';

require('scss/style.scss');

class App extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <ul>
                <li>
                    <h1>hello</h1>
                </li>
                <li>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi, eum.</p>
                </li>
            </ul>
        );
    }
}


render(<App />, document.getElementById('app'));
