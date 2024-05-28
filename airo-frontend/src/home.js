import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

const Home = (props) => {
    const { loggedIn, email } = props
    const [age, setAge] = useState("")
    const [currency_id, setCurrencyId] = useState("")
    const [start_date, setStartDate] = useState("")
    const [end_date, setEndDate] = useState("")
    const [fieldError, setFieldError] = useState("")
    const [result, setResult] = useState("");
    
    const navigate = useNavigate();
    
    const onButtonClick = () => {
        if (loggedIn) {
            localStorage.removeItem("user")
            props.setLoggedIn(false)
        } else {
            navigate("/login")
        }
    }

    const onSubmitClick = (e) => {
        e.preventDefault();

        setFieldError("")

        // Check if the fields are not empty
        if ("" === age || "" === currency_id || "" === start_date || "" === end_date) {
            setFieldError("All fields are required")
            return
        }
        const token = localStorage.getItem("token")
        fetch("http://airo-backend.test/api/quotation", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': `Bearer ${token}`
              },
            body: JSON.stringify({age, currency_id, start_date, end_date})
        })
        .then(r => r.json())
        .then(r => {
            // console.log(r);
            setResult(r)
        })
    }


    return <div className="mainContainer">
        <div className={"titleContainer"}>
            <div>Welcome!</div>
        </div>
        <div>
            Calculate your trip
        </div>
        <div className={"inputContainer"}>
        {(loggedIn ? 
            <div>
                Age:
                <input
                    value={age}
                    placeholder="Enter your age"
                    onChange={ev => setAge(ev.target.value)}
                    className={"inputBox"} />
                Currency: 
                <input 
                    value={currency_id}
                    placeholder="Currency"
                    onChange={ev => setCurrencyId(ev.target.value)}
                    className={"inputBox"} />
                Start date: 
                <input 
                    value={start_date}
                    placeholder="Trip start date"
                    onChange={ev => setStartDate(ev.target.value)}
                    className={"inputBox"} />
                End date: 
                <input 
                    value={end_date}
                    placeholder="Trip end date"
                    onChange={ev => setEndDate(ev.target.value)}
                    className={"inputBox"} />
                <label className="errorLabel">{fieldError}</label>
                <input
                    className={"inputButton"}
                    type="button"
                    onClick={onSubmitClick}
                    value="Submit" />
            </div> :
                <input
                    className={"inputButton"}
                    type="button"
                    onClick={onButtonClick}
                    value={loggedIn ? "" : "Log in"} /> )}



                    {/* {(loggedIn ? <div>
                        Your email address is {email}
                    </div> : <div/>)} */}
        </div>

        <div className="resultContainer">
            <h2>result:</h2> 
            <p>
                Total: {result.total}
                <br></br>
                Currency: {result.currency_id}
                <br></br>
                Quotation: {result.quotation_id}
            </p>
        </div>

    </div>
}

export default Home