#include <vector> 
#include <list> 
#include <map> 
#include <set> 
#include <deque> 
#include <queue> 
#include <stack> 
#include <bitset> 
#include <algorithm> 
#include <functional> 
#include <numeric> 
#include <utility> 
#include <sstream> 
#include <iostream> 
#include <iomanip> 
#include <cstdio> 
#include <cmath> 
#include <cstdlib> 
#include <cctype> 
#include <string> 
#include <cstring> 
#include <cstdio> 
#include <cmath> 
#include <cstdlib> 
#include <ctime> 

using namespace std; 

#define FOR(i,a,b) for(int i=(a);i<(b);++i) 
#define REP(i,a) FOR(i,0,a) 
#define SIZE(X) ((int)(X.size())) 

const int maxn=128; 

int n,n2,d; 
vector<int> g[maxn]; 
double f[maxn][maxn]; 
double h[maxn][maxn]; 
void mergeto(double f[],double t[]) 
{ 
    double g[maxn]; 
    memset(g,0,sizeof(g)); 
    REP(i,n2) REP(j,n2)  
    { 
        if (i+j+1<=d) g[max(i,j+1)]+=f[i]*t[j]*0.5; 
        if (i+j+2<=d) g[max(i,j+2)]+=f[i]*t[j]*0.5; 
    } 
    memcpy(f,g,sizeof(g)); 
} 
void solve(int p,int prev) 
{ 
    REP(i,SIZE(g[p])) if (g[p][i]!=prev) solve(g[p][i],p); 
    memset(f[p],0,sizeof(f[p])); 
    f[p][0]=1; 
    REP(i,SIZE(g[p])) if (g[p][i]!=prev) mergeto(f[p],f[g[p][i]]); 
} 
double getExpectation(vector <int> a, vector <int> b) 
{ 
    n=SIZE(a)+1; 
    REP(i,n-1) g[a[i]].push_back(b[i]); 
    REP(i,n-1) g[b[i]].push_back(a[i]); 
    double ret=0; 
    double prev=0; 
    n2=n+n; 
    FOR(k,1,n2) 
    { 
        d=k; 
        solve(0,-1); 
        double current=0; 
        REP(l,n2) current+=f[0][l]; 
        ret+=k*(current-prev); 
        prev=current; 
    } 
    return ret; 
} 

int main() {
	freopen("tree.in", "r", stdin);
	freopen("tree.out", "w", stdout);
    int n;
    cin >> n;
    vector <int> a(n-1), b(n-1);
    for (int i = 0; i < n - 1; i++) {
        cin >>  a[i];
    }
    for (int i = 0; i < n - 1; i++) {
        cin >> b[i];
    }
    printf("%.9f\n", getExpectation(a, b));
    return 0;
}