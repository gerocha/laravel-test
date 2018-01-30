import React, { Component } from 'react';
import './App.css';
import axios from 'axios'
import FileUpload from './components/FileUpload'
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import darkBaseTheme from 'material-ui/styles/baseThemes/darkBaseTheme';
import {
  Table,
  TableBody,
  TableHeader,
  TableHeaderColumn,
  TableRow,
  TableRowColumn,
} from 'material-ui/Table';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      offerList: []
    }
  }

  handleFileUpload(target) {
    let { files } = target.target
    let fileToUpload = files[0]
    let data = new FormData();
    data.append('file', fileToUpload);
    data.append('name', fileToUpload.name);
    axios.post('http://localhost:8080/api/source_file', data)
  }

  componentWillMount() {
    axios.get('http://localhost:8080/api/offer').then((res) => {
      this.setState({ offerList: res.data })
    })
  }

  render() {
    console.log(this.state.offerList)
    return (
      <div className="App">
        <FileUpload onChange={this.handleFileUpload} />
        <MuiThemeProvider muiTheme={getMuiTheme(darkBaseTheme)}>
          <Table>
            <TableHeader >
              <TableRow>
                <TableHeaderColumn tooltip="The Name">BeginDate</TableHeaderColumn>
                <TableHeaderColumn tooltip="The Status">EndDate</TableHeaderColumn>
                <TableHeaderColumn tooltip="The Status">Description</TableHeaderColumn>
                <TableHeaderColumn tooltip="The Status">PublicDescription</TableHeaderColumn>
                <TableHeaderColumn tooltip="The Status">PurchaseUrl</TableHeaderColumn>
                <TableHeaderColumn tooltip="The Status">Regulation</TableHeaderColumn>
                <TableHeaderColumn tooltip="The Status">Title</TableHeaderColumn>
              </TableRow>
            </TableHeader>
            <TableBody>
              {this.state.offerList.map( (row, index) => (
                <TableRow key={index}>
                  <TableRowColumn>{row.begin_date}</TableRowColumn>
                  <TableRowColumn>{row.end_date}</TableRowColumn>
                  <TableRowColumn>{row.description}</TableRowColumn>
                  <TableRowColumn>{row.public_description}</TableRowColumn>
                  <TableRowColumn>{row.purchase_url}</TableRowColumn>
                  <TableRowColumn>{row.regulation}</TableRowColumn>
                  <TableRowColumn>{row.title}</TableRowColumn>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </MuiThemeProvider>
      </div>
    );
  }
}

export default App;
