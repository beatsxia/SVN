function Content1(props)
{
    var diyStyle = {
        red : {
            color : "#fb6872"
        }
    };
    var item1 = [
        499,
        999,
        1499,
        1600,
        1700,
        1800
    ];
    var item2 = [
        1900,
        2000,
        2100,
        2200,
        2300,
        5000
    ];
    

    return(
        <React.Fragment>
            <h3 className="explain-title">{props.title}</h3>
            <ol className="table-top">
                <li>等级</li>
                {item1.map((val,key)=>{
                    return(
                        <li class="short-line">{key+1}</li>
                    );
                })}
            </ol>
            <ul className="table-body">
                <li>
                    <span style = {diyStyle.red}>灵值</span>
                    {item1.map((val)=>{
                        return(
                            <span>{val}</span>
                        );
                    })}
                </li>
            </ul>
            <ol className="table-top">
                <li>等级</li>
                {item2.map((val,key)=>{
                    return(
                        <li class="short-line">{key+7}</li>
                    );
                })}
            </ol>
            <ul className="table-body">
                <li>
                    <span style = {diyStyle.red}>灵值</span>
                    {item2.map((val)=>{
                        return(
                            <span>{val}</span>
                        );
                    })}
                </li>
            </ul>
            <p>
                灵值获取方法:<br/>
                每天点击“+能量”按钮可随机获取灵值；<br/>
                备注：每天碑主最高可获得的灵值上限是1888
            </p>
        </React.Fragment>
    );
}

function Content2(props)
{
    var diyStyle = {
        red : {
            color : "#fb6872"
        },
        backY : {
            backgroundColor : "#fff001"
        },
        black : {
            color : "#333333"
        }
    };
    
    return(
        <React.Fragment>
            <h3 className="explain-title">{props.title}</h3>
            <ol className="table-top" style = {diyStyle.backY}>
                <li style = {diyStyle.black}>等级</li>
                <li class="short-line" style = {diyStyle.black}>1</li>
                <li class="short-line" style = {diyStyle.black}>2~9</li>
                <li class="short-line" style = {diyStyle.black}>10</li>
                <li class="short-line" style = {diyStyle.black}>11</li>
                <li class="short-line" style = {diyStyle.black}>12</li>
            </ol>
            <ul className="table-body">
                <li>
                    <span style = {diyStyle.red}>赠送灵石</span>
                    <span>500</span>
                    <span>1000</span>
                    <span>2000</span>
                    <span>3000</span>
                    <span>5000</span>
                </li>
            </ul>
        </React.Fragment>
    );
}

function Content3(props)
{
    var diyStyle = {
        backY : {
            backgroundColor : "#fff001"
        },
        tableTop : {
            borderBottom : "none"
        }
    };
    
    return(
        <React.Fragment>
            <h3 className="explain-title">{props.title}</h3>
            <ol className="table-top" style = {diyStyle.tableTop}>
                <li>等级</li>
                <li class="long-line">需用灵石</li>
                <li class="long-line">风水位置</li>
            </ol>
            <ul className="table-body t3">
                <li>
                    <span style = {diyStyle.backY}>1</span>
                    <span>0</span>
                    <span>穴位</span>
                </li>
                <li>
                    <span style = {diyStyle.backY}>2</span>
                    <span>600</span>
                    <span>来龙</span>
                </li>
                <li>
                    <span style = {diyStyle.backY}>3</span>
                    <span>800</span>
                    <span>内青龙or内白虎</span>
                </li>
                <li className="cell-two">
                    <span style = {diyStyle.backY}>4</span>
                    <span>
                        <span>800</span>
                        <span>1000</span>
                    </span>
                    <span>
                        <span>外青龙</span>
                        <span>外白虎</span>
                    </span>
                </li>
                <li>
                    <span style = {diyStyle.backY}>5</span>
                    <span>1000</span>
                    <span>虾须水or明堂</span>
                </li>
                <li>
                    <span style = {diyStyle.backY}>6</span>
                    <span>1000</span>
                    <span>龙虎水</span>
                </li>
                <li>
                    <span style = {diyStyle.backY}>7</span>
                    <span>3000</span>
                    <span>主山</span>
                </li>
                <li>
                    <span style = {diyStyle.backY}>8</span>
                    <span>2000</span>
                    <span>案山</span>
                </li>
                <li>
                    <span style = {diyStyle.backY}>9</span>
                    <span>6000</span>
                    <span>龙脉</span>
                </li>
                <li>
                    <span style = {diyStyle.backY}>10</span>
                    <span>3000</span>
                    <span>朱雀山or水口山</span>
                </li>
                <li className="cell-two">
                    <span style = {diyStyle.backY}>11</span>
                    <span>
                        <span>3000</span>
                        <span>4000</span>
                    </span>
                    <span>
                        <span>水口</span>
                        <span>朝山</span>
                    </span>
                </li>
                <li>
                    <span style = {diyStyle.backY}>12</span>
                    <span>5000</span>
                    <span>祖宗山</span>
                </li>
            </ul>
        </React.Fragment>
    );
}

ReactDOM.render(
    <Content1 title="一、灵值等级划分" />
    ,
    document.getElementById('content1')
);
ReactDOM.render(
    <Content2 title="二、升级灵石奖励" />
    ,
    document.getElementById('content2')
);
ReactDOM.render(
    <Content3 title="三、解锁风水区位" />
    ,
    document.getElementById('content3')
);
