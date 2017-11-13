import React from 'react';
import ReactDOM from 'react-dom';
import CustomButton from './test.jsx';

export default class Demo extends React.Component {
    constructor(props) {
        super(props);
    }
    render() {
        return <CustomButton/>;
    }
}

ReactDOM.render( <Demo />, document.getElementById('app') );
