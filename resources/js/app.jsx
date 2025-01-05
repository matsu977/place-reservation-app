import "./bootstrap";
import "../css/app.css";

import ReactDOM from "react-dom/client";
import StorageSpaceEditor from "./components/StorageSpaceEditor";
function App() {
    return (
        <>
            
            <StorageSpaceEditor />
        </>
    );

}

const root = ReactDOM.createRoot(document.getElementById("app"));
root.render(<App />);