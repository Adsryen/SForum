<div class="card card-body">
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label class="form-label">{{__("admin.setting.Whether to enable rendering of twemoji")}}</label>
                <select class="form-control" v-model="data.contentParse_twemoji">
                    <option value="开启">{{__("admin.turn on")}}</option>
                    <option value="关闭">{{__("admin.turn off")}}</option>
                </select>
                <small>当前: {{get_options("contentParse_twemoji",'开启')}}</small>
            </div>
            <div class="col-6">
                <label class="form-label">{{__("admin.setting.twemoji static resource library")}}</label>
                <select class="form-control" v-model="data.contentParse_twemoji_cdn">
                    <option value="https://twemoji.maxcdn.com/v/latest">maxcdn</option>
                    <option value="https://lib.baomitu.com/twemoji/1.4.2">baomitu</option>
                    <option value="https://lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/twemoji/13.1.0">字节跳动(版本低)</option>
                </select>
                <small>{{__("admin.default",['default'=>'baomitu'])}}</small>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label class="form-label">{{__("admin.setting.twemoji image width")}}</label>
                <input type="number" class="form-control" min="1" v-model="data.contentParse_twemoji_contentParse_width">
                <small>{{__("admin.current",['current' => get_options("contentParse_twemoji_contentParse_width",25)])}}</small>
            </div>
            <div class="col-6">
                <label class="form-label">{{__("admin.setting.twemoji image height")}}</label>
                <input type="number" class="form-control" min="1" v-model="data.contentParse_twemoji_contentParse_height">
                <small>{{__("admin.current",['current' => get_options("contentParse_twemoji_contentParse_height",25)])}}</small>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-3">
                <label class="form-label">{{__("admin.setting.Whether to enable rendering of owo expressions")}}</label>
                <select class="form-control" v-model="data.contentParse_owo">
                    <option value="开启">{{__("admin.turn on")}}</option>
                    <option value="关闭">{{__("admin.turn off")}}</option>
                </select>
                <small>{{__("admin.current",['current' => get_options("contentParse_owo",'开启')])}}</small>
            </div>
            <div class="col-3">
                <label class="form-label">是否开启 owo 文字表情渲染</label>
                <select class="form-control" v-model="data.contentParse_owo_text">
                    <option value="开启">开启</option>
                    <option value="关闭">关闭</option>
                </select>
                <small>当前: {{get_options("contentParse_owo_text",'开启')}}</small>
            </div>
            <div class="col-3">
                <label class="form-label">是否开启 owo 图片表情渲染</label>
                <select class="form-control" v-model="data.contentParse_owo_img">
                    <option value="开启">开启</option>
                    <option value="关闭">关闭</option>
                </select>
                <small>当前: {{get_options("contentParse_owo_img",'开启')}}</small>
            </div>
            <div class="col-3">
                <label class="form-label">owo 表情图片宽度</label>
                <input type="number" v-model="data.contentParse_owo_width" min="1" class="form-control">
                <small>当前: {{get_options("contentParse_owo_width",30)}}</small>
            </div>
            <div class="col-3">
                <label class="form-label"> owo 表情图片高度</label>
                <input type="number" v-model="data.contentParse_owo_height" min="1" class="form-control">
                <small>当前: {{get_options("contentParse_owo_height",30)}}</small>
            </div>
        </div>
    </div>


</div>