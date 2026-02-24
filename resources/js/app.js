import HttpRequest from "./components/HttpRequest";
import {createApp} from 'vue'
import Feature from './components/Feature'
import Features from './components/Features'
import Dots from './components/Dots'
import HttpHeader from "./components/HttpHeader";
import CodeBlock from "./components/CodeBlock";

require('./bootstrap')

const app = createApp({})

app.component('feature', Feature)
app.component('features', Features)
app.component('dots', Dots)
app.component('http-request', HttpRequest)
app.component('http-header', HttpHeader)
app.component('code-block', CodeBlock)

app.mount('#app')
