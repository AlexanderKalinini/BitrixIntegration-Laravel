import axios from "axios";

export async function getLeads() {
    try {
        const res = await axios.get("/api/getLeads");
        return res.data;
    } catch (err) {
        console.log(err);
    }
}
