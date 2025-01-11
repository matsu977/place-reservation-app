import "./bootstrap";
import "../css/app.css";

import ReactDOM from "react-dom/client";
import StorageSpaceEditor from "./components/StorageSpaceEditor";
import { Layout } from "./components/Layout";

function App() {
    return (
        <Layout>
            <StorageSpaceEditor />
        </Layout>
    );

}

const root = ReactDOM.createRoot(document.getElementById("app"));
root.render(<App />);