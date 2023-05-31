$(document).ready(function(){
    // 

    class RegisterWork {
        constructor(userData){
            this.userData = userData;
            this.account = userData["account"];
            this.password = userData['password'];
            this.gender = userData['gender'];
            this.email = userData['email'];
            this.serviceAgree = userData['termsOfService'];
            this.fillCheck = true;
        }
        _bigWordCheck(word){
            let bigWriteList = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","B","W","X","Y","Z"]
            for(let i=0; i<bigWriteList.length; i++){
                if(word == bigWriteList[i]){
                    return true;
                }
            }
            return false;
        }
        _fillBadClean(){
            $('tbody.wrong').find('.warning').parents('tr').remove();
            $('tbody.wrong').removeClass('wrong');
        }
        _fillBad(target){
            $('input[name="' + target + '"]').parents('tbody').addClass('wrong');
            $('input[name="' + target + '"]').parents('tbody').append('<tr><td colspan="2"><span class="warning">沒有填對喔！</span></td></tr>');
        };
        _accountCheck(){
            let var_this = this;
            return new Promise(function(resolve){
                // 確認有輸入內容
                if(var_this.account == ''){
                    resolve(false);
                }
                let result = false;
                $.ajax({
                    type: "POST",
                    url: "accountCheck.php",
                    data: {
                        "account": var_this.account
                    }
                }).done(function(data){
                    if(data == "OK"){
                        result = true;
                    } else {
                        result = false;
                    }
                    resolve(result);
                })
            })
        }
        _passwordCheck(){
            // 確認有輸入內容且大於四碼
            if(this.password.length < 4){
                return false;
            }
            // 確認有同時包含一個數字與一個大寫英文字母
            let oneNum = false;
            let bigWord = false;
            for(let i=0; i<this.password.length; i++){
                if(oneNum == true && bigWord == true){
                    break;
                }
                if(!Number.isNaN(parseInt(this.password[i]))){
                    oneNum = true;
                    continue;
                }
                if(bigWord == false){
                    bigWord = this._bigWordCheck(this.password[i])
                }
            }
            // 確認有包含一個數字
            if(oneNum == false){
                return false;
            }
            // 確認有包含一個大寫英文字母
            if(bigWord == false){
                return false;
            }
            return true;
        }
        _genderCheck(){
            // 確認有選擇內容
            if(this.gender != "male"){
                if(this.gender != "female"){
                    return false;
                }
            }
            return true;
        }
        _emailCheck(){
            // 確認有輸入內容
            if(this.email == ""){
                return false;
            }
            return true;
        }
        _serviceAgreeCheck(){
            // 確認有選擇同意
            if(this.serviceAgree != "agree"){
                return false;
            }
            return true;
        }
        async dataScan(){
            this._fillBadClean();
            if(!await this._accountCheck()){
                this._fillBad("account")
                this.fillCheck = false;
            };
            if(!await this._passwordCheck()){
                this._fillBad("password")
                this.fillCheck = false;
            };
            if(!await this._genderCheck()){
                this._fillBad("gender")
                this.fillCheck = false;
            };
            if(!await this._emailCheck()){
                this._fillBad("email")
                this.fillCheck = false;
            };
            if(!await this._serviceAgreeCheck()){
                this._fillBad("termsOfService")
                this.fillCheck = false;
            };
            return this.fillCheck;
        }
        dataSet(){
            let var_this = this;
            $.ajax({
                type: "POST",
                url: "register.php",
                data: var_this.userData
            }).done(function(){
                location.href = "index.php";
            }).fail(function(){
                alert("註冊資料有錯！");
            });
        }
    }


    // 
})