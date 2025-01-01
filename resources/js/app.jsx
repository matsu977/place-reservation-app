import "./bootstrap";
import "../css/app.css";

import ReactDOM from "react-dom/client";
import StorageSpaceEditor from "./components/StorageSpaceEditor";
function App() {
    return (
        <>
            <h1>Hello World</h1>
            <StorageSpaceEditor />
        </>
    );

}

const root = ReactDOM.createRoot(document.getElementById("app"));
root.render(<App />);