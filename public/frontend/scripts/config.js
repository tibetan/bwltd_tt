const config = {
    apiDomain: "http://localhost",
    getApiUrl: function(endpoint) {
        return `${this.apiDomain}/api/${endpoint}`;
    },
    iPCountryHeaderValue: "", // For test
};

export default config;
